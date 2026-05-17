@extends('layouts.admin')

@section('title', 'Edit Home Services Page')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-heading">Home Services Page Builder</h1>
    <p class="text-sm text-body">Manage Trusted Badges, Service Categories, and FAQs below the slider.</p>
</div>

<form action="{{ route('admin.cms.update', $page->id) }}" method="POST" id="homeServicesForm" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div class="space-y-6">
        <!-- TRUSTED BADGES -->
        <div class="bg-white rounded-lg shadow-sm border border-default overflow-hidden">
            <div class="px-6 py-4 border-b border-default bg-neutral-primary-soft flex justify-between items-center">
                <h3 class="font-bold text-heading">1. Trusted Badges</h3>
                <button type="button" onclick="addBadge()" class="text-xs bg-blue-600 text-white px-3 py-1.5 rounded hover:bg-blue-700 font-medium">
                    <i class="fas fa-plus"></i> Add Badge
                </button>
            </div>
            <div class="p-6 overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-4 py-2">Icon Type</th>
                            <th class="px-4 py-2">Icon Class / Image</th>
                            <th class="px-4 py-2">Title</th>
                            <th class="px-4 py-2">Subtitle</th>
                            <th class="px-4 py-2">Color Class</th>
                            <th class="px-4 py-2 w-20">Action</th>
                        </tr>
                    </thead>
                    <tbody id="badgesList" class="divide-y divide-gray-100">
                    </tbody>
                </table>
            </div>
        </div>

        <!-- SERVICE CATEGORIES -->
        <div class="bg-white rounded-lg shadow-sm border border-default overflow-hidden">
            <div class="px-6 py-4 border-b border-default bg-neutral-primary-soft flex justify-between items-center">
                <h3 class="font-bold text-heading">2. Service Categories Grid</h3>
                <button type="button" onclick="addCategory()" class="text-xs bg-blue-600 text-white px-3 py-1.5 rounded hover:bg-blue-700 font-medium">
                    <i class="fas fa-plus"></i> Add Category
                </button>
            </div>
            <div class="p-6 overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-4 py-2">Icon Type</th>
                            <th class="px-4 py-2">Icon Class / Image</th>
                            <th class="px-4 py-2">Title</th>
                            <th class="px-4 py-2">Description</th>
                            <th class="px-4 py-2">Link</th>
                            <th class="px-4 py-2 w-20">Action</th>
                        </tr>
                    </thead>
                    <tbody id="categoriesList" class="divide-y divide-gray-100">
                    </tbody>
                </table>
            </div>
        </div>

        <!-- FAQS -->
        <div class="bg-white rounded-lg shadow-sm border border-default overflow-hidden">
            <div class="px-6 py-4 border-b border-default bg-neutral-primary-soft flex justify-between items-center">
                <h3 class="font-bold text-heading">3. Frequently Asked Questions (FAQ)</h3>
                <button type="button" onclick="addFaq()" class="text-xs bg-blue-600 text-white px-3 py-1.5 rounded hover:bg-blue-700 font-medium">
                    <i class="fas fa-plus"></i> Add FAQ
                </button>
            </div>
            <div class="p-6 overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-4 py-2 w-1/3">Question</th>
                            <th class="px-4 py-2">Answer</th>
                            <th class="px-4 py-2 w-20">Action</th>
                        </tr>
                    </thead>
                    <tbody id="faqsList" class="divide-y divide-gray-100">
                    </tbody>
                </table>
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

<script>
    let data = {!! json_encode($data) !!};
    if(!data.badges) data.badges = [];
    if(!data.categories) data.categories = [];
    if(!data.faqs) data.faqs = [];

    function renderBadges() {
        const tbody = document.getElementById('badgesList');
        tbody.innerHTML = '';
        data.badges.forEach((item, index) => {
            const isImg = (item.icon_type === 'image');
            tbody.innerHTML += `
                <tr>
                    <td class="p-2">
                        <select name="badges[${index}][icon_type]" class="w-full border rounded p-2 text-sm" onchange="toggleIconInput(this, 'badge-icon-box-${index}')">
                            <option value="class" ${!isImg ? 'selected' : ''}>FontAwesome Class</option>
                            <option value="image" ${isImg ? 'selected' : ''}>Image Upload</option>
                        </select>
                    </td>
                    <td class="p-2" id="badge-icon-box-${index}">
                        ${isImg 
                            ? `<input type="hidden" name="badges[${index}][icon]" value="${item.icon || ''}"><input type="file" name="badges[${index}][icon_file]" class="w-full text-sm"><br><img src="/storage/${item.icon}" class="h-8 mt-1 object-contain">`
                            : `<input type="text" name="badges[${index}][icon]" class="w-full border rounded p-2 text-sm" value="${item.icon || ''}" placeholder="fas fa-medal">`
                        }
                    </td>
                    <td class="p-2"><input type="text" name="badges[${index}][title]" class="w-full border rounded p-2 text-sm" value="${item.title || ''}"></td>
                    <td class="p-2"><input type="text" name="badges[${index}][subtitle]" class="w-full border rounded p-2 text-sm" value="${item.subtitle || ''}"></td>
                    <td class="p-2"><input type="text" name="badges[${index}][color]" class="w-full border rounded p-2 text-sm" value="${item.color || ''}"></td>
                    <td class="p-2"><button type="button" onclick="removeData('badges', ${index})" class="text-red-500 hover:text-red-700"><i class="fas fa-trash"></i></button></td>
                </tr>
            `;
        });
    }

    function renderCategories() {
        const tbody = document.getElementById('categoriesList');
        tbody.innerHTML = '';
        data.categories.forEach((item, index) => {
            const isImg = (item.icon_type === 'image');
            tbody.innerHTML += `
                <tr>
                    <td class="p-2">
                        <select name="categories[${index}][icon_type]" class="w-full border rounded p-2 text-sm" onchange="toggleIconInput(this, 'cat-icon-box-${index}')">
                            <option value="class" ${!isImg ? 'selected' : ''}>FontAwesome Class</option>
                            <option value="image" ${isImg ? 'selected' : ''}>Image Upload</option>
                        </select>
                    </td>
                    <td class="p-2" id="cat-icon-box-${index}">
                        ${isImg 
                            ? `<input type="hidden" name="categories[${index}][icon]" value="${item.icon || ''}"><input type="file" name="categories[${index}][icon_file]" class="w-full text-sm"><br><img src="/storage/${item.icon}" class="h-8 mt-1 object-contain">`
                            : `<input type="text" name="categories[${index}][icon]" class="w-full border rounded p-2 text-sm" value="${item.icon || ''}" placeholder="fas fa-laptop">`
                        }
                    </td>
                    <td class="p-2"><input type="text" name="categories[${index}][title]" class="w-full border rounded p-2 text-sm" value="${item.title || ''}"></td>
                    <td class="p-2"><textarea name="categories[${index}][description]" class="w-full border rounded p-2 text-sm" rows="2">${item.description || ''}</textarea></td>
                    <td class="p-2"><input type="text" name="categories[${index}][link]" class="w-full border rounded p-2 text-sm" value="${item.link || ''}"></td>
                    <td class="p-2"><button type="button" onclick="removeData('categories', ${index})" class="text-red-500 hover:text-red-700"><i class="fas fa-trash"></i></button></td>
                </tr>
            `;
        });
    }

    function renderFaqs() {
        const tbody = document.getElementById('faqsList');
        tbody.innerHTML = '';
        data.faqs.forEach((item, index) => {
            tbody.innerHTML += `
                <tr>
                    <td class="p-2"><input type="text" name="faqs[${index}][question]" class="w-full border rounded p-2 text-sm" value="${item.question || ''}"></td>
                    <td class="p-2"><textarea name="faqs[${index}][answer]" class="w-full border rounded p-2 text-sm" rows="2">${item.answer || ''}</textarea></td>
                    <td class="p-2"><button type="button" onclick="removeData('faqs', ${index})" class="text-red-500 hover:text-red-700"><i class="fas fa-trash"></i></button></td>
                </tr>
            `;
        });
    }

    function toggleIconInput(selectElem, boxId) {
        const type = selectElem.value;
        const box = document.getElementById(boxId);
        // Extract array index and type from boxId (e.g., 'badge-icon-box-0' or 'cat-icon-box-1')
        const prefix = boxId.split('-')[0];
        const index = boxId.split('-')[3] || boxId.split('-')[2] || boxId.split('-').pop(); // rough logic
        const arrName = prefix === 'badge' ? 'badges' : 'categories';
        
        if (type === 'image') {
            box.innerHTML = `<input type="hidden" name="${arrName}[${index}][icon]" value=""><input type="file" name="${arrName}[${index}][icon_file]" class="w-full text-sm">`;
        } else {
            box.innerHTML = `<input type="text" name="${arrName}[${index}][icon]" class="w-full border rounded p-2 text-sm" placeholder="fas fa-icon">`;
        }
    }

    function removeData(list, index) {
        data[list].splice(index, 1);
        if(list === 'badges') renderBadges();
        if(list === 'categories') renderCategories();
        if(list === 'faqs') renderFaqs();
    }

    function addBadge() {
        data.badges.push({icon_type: 'class', icon: '', title: '', subtitle: '', color: 'text-[#ef4a23]'});
        renderBadges();
    }

    function addCategory() {
        data.categories.push({icon_type: 'class', icon: '', title: '', description: '', link: '#'});
        renderCategories();
    }

    function addFaq() {
        data.faqs.push({question: '', answer: ''});
        renderFaqs();
    }

    // Initial render
    renderBadges();
    renderCategories();
    renderFaqs();
</script>
@endsection
