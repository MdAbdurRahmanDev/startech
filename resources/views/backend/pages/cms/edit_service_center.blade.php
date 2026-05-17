@extends('layouts.admin')

@section('title', 'Edit Service Center Page')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-heading">Service Center Page Builder</h1>
    <p class="text-sm text-body">Manage Service Steps, Articles, and the Bottom Description.</p>
</div>

<form action="{{ route('admin.cms.update', $page->id) }}" method="POST" id="serviceCenterForm" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div class="space-y-6">
        <!-- STEPS -->
        <div class="bg-white rounded-lg shadow-sm border border-default overflow-hidden">
            <div class="px-6 py-4 border-b border-default bg-neutral-primary-soft flex justify-between items-center">
                <h3 class="font-bold text-heading">1. Service Steps</h3>
                <button type="button" onclick="addStep()" class="text-xs bg-blue-600 text-white px-3 py-1.5 rounded hover:bg-blue-700 font-medium">
                    <i class="fas fa-plus"></i> Add Step
                </button>
            </div>
            <div class="p-6 overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-4 py-2 w-1/4">Title</th>
                            <th class="px-4 py-2">Description</th>
                            <th class="px-4 py-2 w-20">Action</th>
                        </tr>
                    </thead>
                    <tbody id="stepsList" class="divide-y divide-gray-100">
                    </tbody>
                </table>
            </div>
        </div>

        <!-- ARTICLES -->
        <div class="bg-white rounded-lg shadow-sm border border-default overflow-hidden">
            <div class="px-6 py-4 border-b border-default bg-neutral-primary-soft flex justify-between items-center">
                <h3 class="font-bold text-heading">2. Expert Suggestion & Articles</h3>
                <button type="button" onclick="addArticle()" class="text-xs bg-blue-600 text-white px-3 py-1.5 rounded hover:bg-blue-700 font-medium">
                    <i class="fas fa-plus"></i> Add Article
                </button>
            </div>
            <div class="p-6 overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-4 py-2">Icon Type</th>
                            <th class="px-4 py-2">Icon / Image</th>
                            <th class="px-4 py-2">Icon Color Class</th>
                            <th class="px-4 py-2">BG Text (Large)</th>
                            <th class="px-4 py-2">Small Title</th>
                            <th class="px-4 py-2">Large Title</th>
                            <th class="px-4 py-2">Bottom Link Text</th>
                            <th class="px-4 py-2">Link URL</th>
                            <th class="px-4 py-2 w-20">Action</th>
                        </tr>
                    </thead>
                    <tbody id="articlesList" class="divide-y divide-gray-100">
                    </tbody>
                </table>
            </div>
        </div>

        <!-- BOTTOM DESCRIPTION -->
        <div class="bg-white rounded-lg shadow-sm border border-default overflow-hidden">
            <div class="px-6 py-4 border-b border-default bg-neutral-primary-soft">
                <h3 class="font-bold text-heading">3. Bottom Description (HTML)</h3>
            </div>
            <div class="p-6">
                <textarea name="bottom_description" id="bottom_description" class="w-full border rounded p-2">{{ $data['bottom_description'] ?? '' }}</textarea>
            </div>
        </div>

    </div>

    <div class="mt-8 flex gap-4">
        <button type="submit" class="px-8 py-3 bg-fg-brand text-white font-bold rounded-lg hover:bg-opacity-90 shadow-sm transition-all">
            Save Page Content
        </button>
        <a href="{{ route('admin.cms.index') }}" class="px-8 py-3 bg-gray-200 text-gray-700 font-bold rounded-lg hover:bg-gray-300 transition-all">Cancel</a>
    </div>
</form>

@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
    $(document).ready(function() {
        $('#bottom_description').summernote({
            height: 300,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });

    let data = {!! json_encode($data) !!};
    if(!data.steps) data.steps = [];
    if(!data.articles) data.articles = [];

    function renderSteps() {
        const tbody = document.getElementById('stepsList');
        tbody.innerHTML = '';
        data.steps.forEach((item, index) => {
            tbody.innerHTML += `
                <tr>
                    <td class="p-2"><input type="text" name="steps[${index}][title]" class="w-full border rounded p-2 text-sm" value="${item.title || ''}"></td>
                    <td class="p-2"><textarea name="steps[${index}][description]" class="w-full border rounded p-2 text-sm" rows="2">${item.description || ''}</textarea></td>
                    <td class="p-2"><button type="button" onclick="removeData('steps', ${index})" class="text-red-500 hover:text-red-700"><i class="fas fa-trash"></i></button></td>
                </tr>
            `;
        });
    }

    function renderArticles() {
        const tbody = document.getElementById('articlesList');
        tbody.innerHTML = '';
        data.articles.forEach((item, index) => {
            const isImg = (item.icon_type === 'image');
            tbody.innerHTML += `
                <tr>
                    <td class="p-2">
                        <select name="articles[${index}][icon_type]" class="w-full border rounded p-2 text-sm" onchange="toggleIconInput(this, 'article-icon-box-${index}')">
                            <option value="class" ${!isImg ? 'selected' : ''}>Class</option>
                            <option value="image" ${isImg ? 'selected' : ''}>Image</option>
                        </select>
                    </td>
                    <td class="p-2" id="article-icon-box-${index}">
                        ${isImg 
                            ? `<input type="hidden" name="articles[${index}][icon]" value="${item.icon || ''}"><input type="file" name="articles[${index}][icon_file]" class="w-full text-sm"><br><img src="/storage/${item.icon}" class="h-8 mt-1 object-contain">`
                            : `<input type="text" name="articles[${index}][icon]" class="w-full border rounded p-2 text-sm" value="${item.icon || ''}" placeholder="fas fa-video">`
                        }
                    </td>
                    <td class="p-2"><input type="text" name="articles[${index}][icon_color]" class="w-full border rounded p-2 text-sm" value="${item.icon_color || ''}" placeholder="text-yellow-300"></td>
                    <td class="p-2"><input type="text" name="articles[${index}][bg_text]" class="w-full border rounded p-2 text-sm" value="${item.bg_text || ''}" placeholder="PROJECTOR"></td>
                    <td class="p-2"><input type="text" name="articles[${index}][title_small]" class="w-full border rounded p-2 text-sm" value="${item.title_small || ''}" placeholder="How to Prevent"></td>
                    <td class="p-2"><input type="text" name="articles[${index}][title_large]" class="w-full border rounded p-2 text-sm" value="${item.title_large || ''}" placeholder="OVERHEATING"></td>
                    <td class="p-2"><input type="text" name="articles[${index}][badge_text]" class="w-full border rounded p-2 text-sm" value="${item.badge_text || ''}"></td>
                    <td class="p-2"><input type="text" name="articles[${index}][link]" class="w-full border rounded p-2 text-sm" value="${item.link || '#'}"></td>
                    <td class="p-2"><button type="button" onclick="removeData('articles', ${index})" class="text-red-500 hover:text-red-700"><i class="fas fa-trash"></i></button></td>
                </tr>
            `;
        });
    }

    function toggleIconInput(selectElem, boxId) {
        const type = selectElem.value;
        const box = document.getElementById(boxId);
        const index = boxId.split('-').pop();
        const arrName = 'articles';
        
        if (type === 'image') {
            box.innerHTML = `<input type="hidden" name="${arrName}[${index}][icon]" value=""><input type="file" name="${arrName}[${index}][icon_file]" class="w-full text-sm">`;
        } else {
            box.innerHTML = `<input type="text" name="${arrName}[${index}][icon]" class="w-full border rounded p-2 text-sm" placeholder="fas fa-icon">`;
        }
    }

    function removeData(list, index) {
        data[list].splice(index, 1);
        if(list === 'steps') renderSteps();
        if(list === 'articles') renderArticles();
    }

    function addStep() {
        data.steps.push({title: '', description: ''});
        renderSteps();
    }

    function addArticle() {
        data.articles.push({icon_type: 'class', icon: '', icon_color: '', bg_text: '', title_small: '', title_large: '', badge_text: '', link: '#'});
        renderArticles();
    }

    renderSteps();
    renderArticles();
</script>
@endsection
