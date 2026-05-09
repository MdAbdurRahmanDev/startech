@extends('layouts.admin')

@section('title', 'Edit Offer')

@section('styles')
<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        ClassicEditor
            .create(document.querySelector('#long_description'))
            .catch(error => {
                console.error(error);
            });
    });
</script>
<style>
    .ck-editor__editable {
        min-height: 300px;
        background-color: #f9fafb !important;
    }
</style>
@endsection

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-heading">Edit Offer</h1>
    <p class="text-sm text-body">Update promotional campaign details</p>
</div>

<form action="{{ route('admin.offers.update', $offer->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Form -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white border border-default rounded-lg p-6 shadow-sm">
                <div class="mb-5">
                    <label class="block mb-2 text-sm font-bold text-heading">Offer Title</label>
                    <input type="text" name="title" required value="{{ old('title', $offer->title) }}" class="bg-neutral-primary-soft border border-default text-heading text-sm rounded-base focus:ring-brand-light focus:border-fg-brand block w-full p-2.5 outline-none transition-all">
                    @error('title') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-5">
                    <label class="block mb-2 text-sm font-bold text-heading">Short Description</label>
                    <textarea name="short_description" rows="2" class="bg-neutral-primary-soft border border-default text-heading text-sm rounded-base focus:ring-brand-light focus:border-fg-brand block w-full p-2.5 outline-none transition-all">{{ old('short_description', $offer->short_description) }}</textarea>
                </div>

                <div class="mb-0">
                    <label class="block mb-2 text-sm font-bold text-heading">Long Description (Rich Text)</label>
                    <textarea id="long_description" name="long_description">{{ old('long_description', $offer->long_description) }}</textarea>
                </div>
            </div>
        </div>

        <!-- Sidebar Form -->
        <div class="space-y-6">
            <div class="bg-white border border-default rounded-lg p-6 shadow-sm">
                <div class="mb-5">
                    <label class="block mb-2 text-sm font-bold text-heading">Offer Banner</label>
                    <div class="flex items-center justify-center w-full">
                        <label class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-default rounded-lg cursor-pointer bg-neutral-primary-soft hover:bg-neutral-tertiary-medium transition-all relative overflow-hidden">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <i class="fas fa-cloud-upload-alt text-2xl text-gray-400 mb-2"></i>
                                <p class="text-xs text-gray-500 font-bold uppercase">Change Banner</p>
                            </div>
                            <input type="file" name="image" class="hidden" onchange="previewImage(this)" />
                        </label>
                    </div>
                    <div id="image-preview" class="mt-3">
                        <img src="{{ asset('storage/' . $offer->image) }}" class="w-full h-32 object-cover rounded border border-default">
                    </div>
                    @error('image') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4 mb-5">
                    <div>
                        <label class="block mb-2 text-sm font-bold text-heading">Start Date</label>
                        <input type="date" name="start_date" required value="{{ old('start_date', $offer->start_date->format('Y-m-d')) }}" class="bg-neutral-primary-soft border border-default text-heading text-sm rounded-base focus:ring-brand-light focus:border-fg-brand block w-full p-2.5 outline-none transition-all">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold text-heading">End Date</label>
                        <input type="date" name="end_date" required value="{{ old('end_date', $offer->end_date->format('Y-m-d')) }}" class="bg-neutral-primary-soft border border-default text-heading text-sm rounded-base focus:ring-brand-light focus:border-fg-brand block w-full p-2.5 outline-none transition-all">
                    </div>
                </div>

                <div class="mb-5">
                    <label class="block mb-2 text-sm font-bold text-heading">Offer Type</label>
                    <select name="type" required class="bg-neutral-primary-soft border border-default text-heading text-sm rounded-base focus:ring-brand-light focus:border-fg-brand block w-full p-2.5 outline-none transition-all">
                        <option value="Online" {{ $offer->type == 'Online' ? 'selected' : '' }}>Online</option>
                        <option value="All Outlet" {{ $offer->type == 'All Outlet' ? 'selected' : '' }}>All Outlet</option>
                        <option value="Online & All Outlet" {{ $offer->type == 'Online & All Outlet' ? 'selected' : '' }}>Online & All Outlet</option>
                    </select>
                </div>

                <div class="pt-4 border-t border-default">
                    <button type="submit" class="w-full text-white bg-fg-brand hover:bg-opacity-90 focus:ring-4 focus:ring-brand-light font-bold rounded-base text-sm px-5 py-3 text-center transition-all">
                        Update Offer
                    </button>
                    <a href="{{ route('admin.offers.index') }}" class="block w-full mt-2 text-center text-body bg-white border border-default hover:bg-neutral-primary-soft focus:ring-4 focus:ring-neutral-tertiary font-bold rounded-base text-sm px-5 py-3 transition-all">
                        Cancel
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('image-preview');
            preview.querySelector('img').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
