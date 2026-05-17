<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::latest()->paginate(10);
        return view('backend.pages.cms.index', compact('pages'));
    }

    public function create()
    {
        return view('backend.pages.cms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Page::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
        ]);

        return redirect()->route('admin.cms.index')->with('success', 'Page created successfully');
    }

    public function edit(Page $page)
    {
        if ($page->slug === 'home-services') {
            $data = json_decode($page->content, true) ?: ['badges' => [], 'categories' => [], 'faqs' => []];
            return view('backend.pages.cms.edit_home_services', compact('page', 'data'));
        }

        if ($page->slug === 'service-center') {
            $data = json_decode($page->content, true) ?: ['steps' => [], 'articles' => [], 'bottom_description' => ''];
            return view('backend.pages.cms.edit_service_center', compact('page', 'data'));
        }
        return view('backend.pages.cms.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        if ($page->slug === 'home-services') {
            $data = ['badges' => [], 'categories' => [], 'faqs' => []];

            // Process Badges
            if ($request->has('badges') && is_array($request->badges)) {
                foreach ($request->badges as $index => $badge) {
                    $item = [
                        'title' => $badge['title'] ?? '',
                        'subtitle' => $badge['subtitle'] ?? '',
                        'color' => $badge['color'] ?? '',
                        'icon' => $badge['icon'] ?? '',
                        'icon_type' => $badge['icon_type'] ?? 'class'
                    ];

                    if ($request->hasFile("badges.{$index}.icon_file")) {
                        $item['icon'] = $request->file("badges.{$index}.icon_file")->store('icons', 'public');
                        $item['icon_type'] = 'image';
                    }

                    $data['badges'][] = $item;
                }
            }

            // Process Categories
            if ($request->has('categories') && is_array($request->categories)) {
                foreach ($request->categories as $index => $cat) {
                    $item = [
                        'title' => $cat['title'] ?? '',
                        'description' => $cat['description'] ?? '',
                        'link' => $cat['link'] ?? '',
                        'color' => $cat['color'] ?? '',
                        'bg' => $cat['bg'] ?? '',
                        'icon' => $cat['icon'] ?? '',
                        'icon_type' => $cat['icon_type'] ?? 'class'
                    ];

                    if ($request->hasFile("categories.{$index}.icon_file")) {
                        $item['icon'] = $request->file("categories.{$index}.icon_file")->store('icons', 'public');
                        $item['icon_type'] = 'image';
                    }

                    $data['categories'][] = $item;
                }
            }

            // Process FAQs
            if ($request->has('faqs') && is_array($request->faqs)) {
                foreach ($request->faqs as $faq) {
                    $data['faqs'][] = [
                        'question' => $faq['question'] ?? '',
                        'answer' => $faq['answer'] ?? ''
                    ];
                }
            }

            $page->update([
                'content' => json_encode($data),
            ]);
            return redirect()->route('admin.cms.index')->with('success', 'Home Services page updated successfully');
        }

        if ($page->slug === 'service-center') {
            $data = ['steps' => [], 'articles' => [], 'bottom_description' => ''];

            if ($request->has('steps') && is_array($request->steps)) {
                foreach ($request->steps as $step) {
                    $data['steps'][] = [
                        'title' => $step['title'] ?? '',
                        'description' => $step['description'] ?? ''
                    ];
                }
            }

            if ($request->has('articles') && is_array($request->articles)) {
                foreach ($request->articles as $index => $article) {
                    $item = [
                        'badge_text' => $article['badge_text'] ?? '',
                        'bg_text' => $article['bg_text'] ?? '',
                        'icon' => $article['icon'] ?? '',
                        'icon_type' => $article['icon_type'] ?? 'class',
                        'icon_color' => $article['icon_color'] ?? '',
                        'title_small' => $article['title_small'] ?? '',
                        'title_large' => $article['title_large'] ?? '',
                        'link' => $article['link'] ?? ''
                    ];

                    if ($request->hasFile("articles.{$index}.icon_file")) {
                        $item['icon'] = $request->file("articles.{$index}.icon_file")->store('icons', 'public');
                        $item['icon_type'] = 'image';
                    }

                    $data['articles'][] = $item;
                }
            }
            
            $data['bottom_description'] = $request->input('bottom_description', '');

            $page->update([
                'content' => json_encode($data),
            ]);
            return redirect()->route('admin.cms.index')->with('success', 'Service Center page updated successfully');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $page->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
        ]);

        return redirect()->route('admin.cms.index')->with('success', 'Page updated successfully');
    }

    public function destroy(Page $page)
    {
        $page->delete();
        return back()->with('success', 'Page deleted successfully');
    }
}
