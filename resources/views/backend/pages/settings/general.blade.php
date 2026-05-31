@extends('layouts.admin')

@section('title', 'General Settings | IOS BD')

@section('content')
    <div class="max-w-6xl mx-auto py-8">
        <div class="mb-8 flex justify-between items-end">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">General Settings</h1>
                <p class="text-gray-600">Manage your website global configurations, branding, and social links.</p>
            </div>
        </div>

        @if (session('success'))
            <div
                class="bg-green-50 text-green-700 p-4 rounded-lg mb-6 flex items-center gap-3 shadow-sm border border-green-100">
                <i class="fas fa-check-circle text-lg"></i>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column: Branding -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Website Branding -->
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center gap-2">
                            <i class="fas fa-globe text-accent-orange"></i>
                            Website Branding
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Application Name</label>
                                <input type="text" name="app_name"
                                    value="{{ old('app_name', $setting->app_name ?? '') }}"
                                    class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2.5 outline-none focus:border-accent-orange transition-all"
                                    placeholder="Iosbd">
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Homepage Marquee Text</label>
                                <textarea name="marquee_text" rows="3"
                                    class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2.5 outline-none focus:border-accent-orange transition-all"
                                    placeholder="Enter the scrolling text for the homepage marquee...">{{ old('marquee_text', $setting->marquee_text ?? '') }}</textarea>
                                <p class="text-[11px] text-gray-400 mt-1">This text will scroll below the main slider on the homepage.</p>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Website Logo</label>
                                <div class="mt-2 flex items-center gap-5">
                                    @if ($setting && $setting->logo)
                                        <img src="{{ asset('storage/' . $setting->logo) }}" alt="Logo"
                                            class="h-12 w-auto object-contain border rounded p-1 bg-gray-50">
                                    @endif
                                    <input type="file" name="logo"
                                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-accent-orange hover:file:bg-orange-100">
                                </div>
                                <p class="text-[11px] text-gray-400 mt-2 italic">Recommended size: 200x50px. Max 2MB.</p>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Favicon</label>
                                <div class="mt-2 flex items-center gap-5">
                                    @if ($setting && $setting->favicon)
                                        <img src="{{ asset('storage/' . $setting->favicon) }}" alt="Favicon"
                                            class="h-8 w-8 object-contain border rounded p-1 bg-gray-50">
                                    @endif
                                    <input type="file" name="favicon"
                                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-accent-orange hover:file:bg-orange-100">
                                </div>
                                <p class="text-[11px] text-gray-400 mt-2 italic">Recommended size: 32x32px. PNG or ICO.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center gap-2">
                            <i class="fas fa-address-book text-accent-orange"></i>
                            Contact Information
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Contact Email</label>
                                <input type="email" name="contact_email"
                                    value="{{ old('contact_email', $setting->contact_email ?? '') }}"
                                    class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2.5 outline-none focus:border-accent-orange transition-all"
                                    placeholder="info@iosbd.com">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Phone Number</label>
                                <input type="text" name="phone_number"
                                    value="{{ old('phone_number', $setting->phone_number ?? '') }}"
                                    class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2.5 outline-none focus:border-accent-orange transition-all"
                                    placeholder="16793">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Office Address</label>
                                <textarea name="address" rows="3"
                                    class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2.5 outline-none focus:border-accent-orange transition-all">{{ old('address', $setting->address ?? '') }}</textarea>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Google Maps Embed URL</label>
                                <textarea name="map_url" rows="3"
                                    class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2.5 outline-none focus:border-accent-orange transition-all"
                                    placeholder="Paste the iframe src URL from Google Maps share...">{{ old('map_url', $setting->map_url ?? '') }}</textarea>
                                <p class="text-[11px] text-gray-400 mt-2 italic">Go to Google Maps > Share > Embed a map >
                                    Copy the URL inside 'src' attribute.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Text -->
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center gap-2">
                            <i class="fas fa-paragraph text-accent-orange"></i>
                            Footer Information
                        </h3>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Footer Copyright Text</label>
                            <textarea name="footer_text" rows="2"
                                class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2.5 outline-none focus:border-accent-orange transition-all">{{ old('footer_text', $setting->footer_text ?? '') }}</textarea>
                        </div>
                    </div>

                    <!-- First-Time Visit Promotion Popup -->
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center gap-2">
                            <i class="fas fa-bullhorn text-accent-orange"></i>
                            First-Time Visit Promotion Popup
                        </h3>

                        <div class="space-y-6">
                            <div class="flex items-center justify-between pb-4 border-b border-gray-100">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700">Enable Promotion Popup</label>
                                    <p class="text-xs text-gray-400">Toggle whether to show the popup to first-time visitors.</p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="popup_enabled" value="1" class="sr-only peer"
                                        {{ old('popup_enabled', $setting->popup_enabled ?? true) ? 'checked' : '' }}>
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-accent-orange"></div>
                                </label>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Popup Image</label>
                                <div class="mt-2 flex flex-col md:flex-row md:items-center gap-5">
                                    @if ($setting && $setting->popup_image)
                                        <div class="relative group w-full md:w-48 h-32 border rounded-lg overflow-hidden bg-gray-50 flex items-center justify-center p-2">
                                            <img src="{{ asset('storage/' . $setting->popup_image) }}" alt="Popup Image"
                                                class="w-full h-full object-contain">
                                        </div>
                                    @endif
                                    <div class="flex-1">
                                        <input type="file" name="popup_image"
                                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-accent-orange hover:file:bg-orange-100">
                                        <p class="text-[11px] text-gray-400 mt-2 italic">Recommended: square or vertical aspect ratio flyer. Max 12MB.</p>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Redirect Link (Optional)</label>
                                <input type="text" name="popup_link"
                                    value="{{ old('popup_link', $setting->popup_link ?? '') }}"
                                    class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2.5 outline-none focus:border-accent-orange transition-all"
                                    placeholder="e.g. /offers or https://example.com/promo">
                                <p class="text-[11px] text-gray-400 mt-1">If a link is set, clicking the popup image will redirect users to this URL.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Social Links -->
                <div class="space-y-8">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center gap-2">
                            <i class="fas fa-share-nodes text-accent-orange"></i>
                            Social Networks
                        </h3>

                        <div class="space-y-5">
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Facebook URL</label>
                                <div class="relative">
                                    <i class="fab fa-facebook absolute left-4 top-1/2 -translate-y-1/2 text-blue-600"></i>
                                    <input type="url" name="facebook_url"
                                        value="{{ old('facebook_url', $setting->facebook_url ?? '') }}"
                                        class="w-full bg-gray-50 border border-gray-200 rounded-lg pl-10 pr-4 py-2 text-sm outline-none focus:border-accent-orange transition-all">
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">WhatsApp Number</label>
                                <div class="relative">
                                    <i class="fab fa-whatsapp absolute left-4 top-1/2 -translate-y-1/2 text-green-500"></i>
                                    <input type="text" name="whatsapp_number"
                                        value="{{ old('whatsapp_number', $setting->whatsapp_number ?? '') }}"
                                        class="w-full bg-gray-50 border border-gray-200 rounded-lg pl-10 pr-4 py-2 text-sm outline-none focus:border-accent-orange transition-all">
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">YouTube Channel</label>
                                <div class="relative">
                                    <i class="fab fa-youtube absolute left-4 top-1/2 -translate-y-1/2 text-red-600"></i>
                                    <input type="url" name="youtube_url"
                                        value="{{ old('youtube_url', $setting->youtube_url ?? '') }}"
                                        class="w-full bg-gray-50 border border-gray-200 rounded-lg pl-10 pr-4 py-2 text-sm outline-none focus:border-accent-orange transition-all">
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Instagram
                                    Profile</label>
                                <div class="relative">
                                    <i class="fab fa-instagram absolute left-4 top-1/2 -translate-y-1/2 text-pink-600"></i>
                                    <input type="url" name="instagram_url"
                                        value="{{ old('instagram_url', $setting->instagram_url ?? '') }}"
                                        class="w-full bg-gray-50 border border-gray-200 rounded-lg pl-10 pr-4 py-2 text-sm outline-none focus:border-accent-orange transition-all">
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">LinkedIn Profile</label>
                                <div class="relative">
                                    <i class="fab fa-linkedin absolute left-4 top-1/2 -translate-y-1/2 text-blue-700"></i>
                                    <input type="url" name="linkedin_url"
                                        value="{{ old('linkedin_url', $setting->linkedin_url ?? '') }}"
                                        class="w-full bg-gray-50 border border-gray-200 rounded-lg pl-10 pr-4 py-2 text-sm outline-none focus:border-accent-orange transition-all">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Button -->
                    <div class="sticky top-24">
                        <button type="submit"
                            class="w-full bg-primary-dark text-white font-bold py-4 rounded-xl shadow-lg hover:shadow-xl hover:bg-opacity-95 transition-all flex items-center justify-center gap-3 text-lg">
                            <i class="fas fa-save"></i>
                            Update Settings
                        </button>
                        <p class="text-center text-xs text-gray-400 mt-4 italic">Last updated:
                            {{ $setting ? $setting->updated_at->diffForHumans() : 'Never' }}</p>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
