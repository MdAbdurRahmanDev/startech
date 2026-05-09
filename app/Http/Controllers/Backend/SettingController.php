<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function general()
    {
        $setting = Setting::first();
        return view('backend.pages.settings.general', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = Setting::first() ?? new Setting();

        $request->validate([
            'app_name' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:12288',
            'favicon' => 'nullable|image|mimes:png,ico,svg|max:2048',
            'contact_email' => 'nullable|email',
            'phone_number' => 'nullable|string',
            'address' => 'nullable|string',
            'footer_text' => 'nullable|string',
            'facebook_url' => 'nullable|url',
            'whatsapp_number' => 'nullable|string',
            'youtube_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
        ]);

        try {
            $data = $request->except(['logo', 'favicon']);

            if ($request->hasFile('logo')) {
                if ($setting->logo) {
                    Storage::disk('public')->delete($setting->logo);
                }
                $data['logo'] = $request->file('logo')->store('settings', 'public');
            }

            if ($request->hasFile('favicon')) {
                if ($setting->favicon) {
                    Storage::disk('public')->delete($setting->favicon);
                }
                $data['favicon'] = $request->file('favicon')->store('settings', 'public');
            }

            if ($setting->exists) {
                $setting->update($data);
            } else {
                Setting::create($data);
            }

            return back()->with('success', 'Settings updated successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Upload failed: ' . $e->getMessage()]);
        }
    }
}
