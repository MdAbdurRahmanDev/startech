@extends('layouts.admin')

@section('title', 'Add Service')

@section('styles')
<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        ClassicEditor
            .create(document.querySelector('#long_description'))
            .catch(error => { console.error(error); });
    });
</script>
<style>
    .ck-editor__editable { min-height: 300px; background-color: #f9fafb !important; }
</style>
@endsection

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-heading">Add New Service</h1>
    <p class="text-sm text-body">Define a new web or app development service</p>
</div>

<form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white border border-default rounded-lg p-6 shadow-sm">
                <div class="mb-5">
                    <label class="block mb-2 text-sm font-bold text-heading">Service Title</label>
                    <input type="text" name="title" required value="{{ old('title') }}" placeholder="e.g. Custom Web Development" class="bg-neutral-primary-soft border border-default text-heading text-sm rounded-base focus:ring-brand-light focus:border-fg-brand block w-full p-2.5 outline-none transition-all">
                </div>

                <div class="mb-5">
                    <label class="block mb-2 text-sm font-bold text-heading">Short Description</label>
                    <textarea name="short_description" rows="2" placeholder="Brief summary of the service..." class="bg-neutral-primary-soft border border-default text-heading text-sm rounded-base focus:ring-brand-light focus:border-fg-brand block w-full p-2.5 outline-none transition-all">{{ old('short_description') }}</textarea>
                </div>

                <div class="mb-0">
                    <label class="block mb-2 text-sm font-bold text-heading">Long Description (Rich Text)</label>
                    <textarea id="long_description" name="long_description">{{ old('long_description') }}</textarea>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white border border-default rounded-lg p-6 shadow-sm">
                <div class="mb-5">
                    <label class="block mb-2 text-sm font-bold text-heading">FontAwesome Icon Class</label>
                    <input type="text" name="icon" value="{{ old('icon', 'fas fa-code') }}" placeholder="e.g. fas fa-mobile-alt" class="bg-neutral-primary-soft border border-default text-heading text-sm rounded-base focus:ring-brand-light focus:border-fg-brand block w-full p-2.5 outline-none transition-all">
                </div>

                <div class="mb-5">
                    <label class="block mb-2 text-sm font-bold text-heading">Featured Image (Optional)</label>
                    <input type="file" name="image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-brand-light file:text-fg-brand hover:file:bg-opacity-80"/>
                </div>

                <div class="mb-5">
                    <label class="block mb-2 text-sm font-bold text-heading">Display Order</label>
                    <input type="number" name="order" value="{{ old('order', 0) }}" class="bg-neutral-primary-soft border border-default text-heading text-sm rounded-base focus:ring-brand-light focus:border-fg-brand block w-full p-2.5 outline-none transition-all">
                </div>

                <div class="pt-4 border-t border-default">
                    <button type="submit" class="w-full text-white bg-fg-brand hover:bg-opacity-90 focus:ring-4 focus:ring-brand-light font-bold rounded-base text-sm px-5 py-3 text-center transition-all">
                        Create Service
                    </button>
                    <a href="{{ route('admin.services.index') }}" class="block w-full mt-2 text-center text-body bg-white border border-default hover:bg-neutral-primary-soft font-bold rounded-base text-sm px-5 py-3 transition-all">
                        Cancel
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
