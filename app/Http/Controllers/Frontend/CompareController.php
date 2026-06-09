<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CompareController extends Controller
{
    public function index()
    {
        $compareList = session()->get('compare_list', []);
        
        $products = [];
        $specKeys = [];

        if (!empty($compareList)) {
            $products = Product::with(['categories', 'specifications', 'brand', 'reviews'])->whereIn('id', $compareList)->get();
            
            // Re-order based on session array order (optional, but good for UX)
            $products = $products->sortBy(function($model) use ($compareList) {
                return array_search($model->id, $compareList);
            })->values();

            foreach ($products as $product) {
                $parsed = $this->parseHtmlTable($product->specifications_text);
                
                // Add actual relation specifications
                foreach ($product->specifications as $spec) {
                    $parsed['General'][$spec->name] = $spec->value;
                }
                
                $product->parsed_specs = $parsed;

                foreach ($parsed as $category => $items) {
                    if (!isset($specKeys[$category])) {
                        $specKeys[$category] = [];
                    }
                    foreach ($items as $key => $val) {
                        if (!in_array($key, $specKeys[$category])) {
                            $specKeys[$category][] = $key;
                        }
                    }
                }
            }
        }

        return view('frontend.compare', compact('products', 'specKeys'));
    }

    private function parseHtmlTable($html)
    {
        if (empty($html)) return [];
        
        $specs = [];
        $dom = new \DOMDocument();
        @$dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        
        $currentCategory = 'General';
        $rows = $dom->getElementsByTagName('tr');
        
        foreach ($rows as $row) {
            $cells = $row->getElementsByTagName('td');
            if ($cells->length == 0) {
                $cells = $row->getElementsByTagName('th');
            }
            
            if ($cells->length == 1) {
                $currentCategory = trim($cells->item(0)->textContent);
                if (empty($currentCategory)) {
                    $currentCategory = 'General';
                }
            } elseif ($cells->length >= 2) {
                $key = trim($cells->item(0)->textContent);
                $value = '';
                foreach ($cells->item(1)->childNodes as $child) {
                    $value .= $dom->saveHTML($child);
                }
                $value = trim($value);
                
                if ($key && $value) {
                    $specs[$currentCategory][$key] = $value;
                }
            }
        }
        
        return $specs;
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $productId = $request->product_id;
        $compareList = session()->get('compare_list', []);

        if (!in_array($productId, $compareList)) {
            if (count($compareList) >= 4) {
                return response()->json(['success' => false, 'message' => 'You can add a maximum of 4 products to compare.'], 400);
            }
            $compareList[] = $productId;
            session()->put('compare_list', $compareList);
        }

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Product added to compare.']);
        }

        return redirect()->route('compare.index');
    }

    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
        ]);

        $productId = $request->product_id;
        $compareList = session()->get('compare_list', []);

        if (($key = array_search($productId, $compareList)) !== false) {
            unset($compareList[$key]);
            session()->put('compare_list', array_values($compareList)); // Reindex
        }

        return redirect()->route('compare.index');
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        if (!$query) {
            return response()->json([]);
        }

        $products = Product::where('status', 1)
            ->where('name', 'LIKE', "%{$query}%")
            ->take(10)
            ->get(['id', 'name', 'thumbnail', 'price', 'discount_price', 'is_call_for_price']);

        $results = $products->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'thumbnail' => $product->thumbnail ? asset('storage/' . $product->thumbnail) : 'https://placehold.co/100x100/f9fafb/a3a3a3?text=No+Image',
                'price' => $product->discount_price && $product->discount_price < $product->price ? number_format($product->discount_price, 0) : number_format($product->price, 0),
            ];
        });

        return response()->json($results);
    }
}
