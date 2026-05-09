@extends('layouts.admin')

@section('title', 'Create CMS Page')

@section('styles')
<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        ClassicEditor
            .create(document.querySelector('#page_content'))
            .catch(error => { console.error(error); });
    });
</script>
<style>
    .ck-editor__editable { min-height: 500px; background-color: #f9fafb !important; }
</style>
@endsection

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-heading">Create New Page</h1>
    <p class="text-sm text-body">Define a new information or policy page</p>
</div>

<form action="{{ route('admin.cms.store') }}" method="POST">
    @csrf
    <div class="bg-white border border-default rounded-lg p-6 shadow-sm space-y-6">
        <div>
            <label class="block mb-2 text-sm font-bold text-heading">Page Title</label>
            <input type="text" name="title" required value="{{ old('title') }}" placeholder="e.g. Privacy Policy" class="bg-neutral-primary-soft border border-default text-heading text-sm rounded-base focus:ring-brand-light focus:border-fg-brand block w-full p-2.5 outline-none transition-all">
        </div>

        <div>
            <label class="block mb-2 text-sm font-bold text-heading">Page Content (Rich Text)</label>
            <textarea id="page_content" name="content">{{ old('content') }}</textarea>
        </div>

        <div class="pt-6 border-t border-default flex gap-4">
            <button type="submit" class="text-white bg-fg-brand hover:bg-opacity-90 focus:ring-4 focus:ring-brand-light font-bold rounded-base text-sm px-8 py-3 transition-all">
                Create Page
            </button>
            <a href="{{ route('admin.cms.index') }}" class="text-body bg-white border border-default hover:bg-neutral-primary-soft font-bold rounded-base text-sm px-8 py-3 transition-all">
                Cancel
            </a>
        </div>
    </div>
</form>
@endsection
