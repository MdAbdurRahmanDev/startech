import re

with open('resources/views/frontend/product/single.blade.php', 'r') as f:
    content = f.read()

# Remove style block entirely
content = re.sub(r'<style>.*?</style>', '', content, flags=re.DOTALL)

# Class mappings
mappings = {
    'class="product-details-section"': 'class="bg-white p-[30px] rounded-lg mt-5 shadow-sm"',
    'class="product-main"': 'class="grid grid-cols-1 lg:grid-cols-2 gap-10"',
    'class="product-gallery"': 'class=""',
    'class="main-image"': 'class="p-[30px] border border-[#f2f4f8] rounded-lg mb-[15px] text-center"',
    'id="main-product-image"': 'id="main-product-image" class="max-w-full max-h-[380px] object-contain mx-auto"',
    'class="thumb-images"': 'class="thumb-images flex gap-2.5 flex-wrap justify-center"',
    # For thumb-images img, we can't easily replace just the class since they don't have one initially except 'active'
    # We will handle thumbnail images via a regex
    'class="product-info-column"': 'class=""',
    '<h1>{{ $product->name }}</h1>': '<h1 class="text-[22px] text-accent-blue mb-[15px] leading-snug font-bold">{{ $product->name }}</h1>',
    'class="meta-tag"': 'class="bg-[#f2f4f8] py-1 px-3.5 rounded-full text-[13px] text-gray-800 inline-block"',
    'class="key-features"': 'class="key-features"',
    'class="payment-options"': 'class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6"',
    'class="payment-card active"': 'class="payment-card active border-2 border-accent-blue bg-[#f0f4f9] p-4 rounded-lg flex items-start gap-3 cursor-pointer transition-colors"',
    'class="payment-card"': 'class="payment-card border-2 border-gray-200 p-4 rounded-lg flex items-start gap-3 cursor-pointer transition-colors hover:border-accent-blue"',
    'class="price-details"': 'class=""',
    '<h4>{{ number_format': '<h4 class="text-[18px] text-gray-800 mb-1 font-bold">{{ number_format',
    '<p>Cash / Online Price</p>': '<p class="text-[12px] text-gray-600 leading-relaxed">Cash / Online Price</p>',
    '<p>Online / Cash Payment</p>': '<p class="text-[12px] text-gray-600 leading-relaxed">Online / Cash Payment</p>',
    '<p>Regular Price:': '<p class="text-[12px] text-gray-600 leading-relaxed">Regular Price:',
    '<p>0% EMI up to 12 Months</p>': '<p class="text-[12px] text-gray-600 leading-relaxed">0% EMI up to 12 Months</p>',
    'class="buy-actions"': 'class="mt-6 flex items-center gap-4"',
    'class="qty-selector"': 'class="flex items-center border border-gray-300 rounded overflow-hidden"',
    'class="buy-now-btn"': 'class="bg-accent-blue text-white py-3 px-10 rounded font-bold flex-grow text-center transition-colors hover:bg-accent-orange block"',
    
    'class="product-content-wrapper"': 'class="mt-10"',
    'class="section-nav"': 'class="section-nav flex gap-2.5 mb-5 flex-wrap"',
    # The active class on section-nav a is dynamic from js or hardcoded.
    
    'class="content-layout"': 'class="grid grid-cols-1 lg:grid-cols-[1fr_300px] gap-5 items-start"',
    'class="main-content"': 'class=""',
    'class="content-card"': 'class="bg-white rounded-lg shadow-sm p-6 mb-5"',
    'class="content-card description-content"': 'class="bg-white rounded-lg shadow-sm p-6 mb-5 text-[14px] leading-relaxed text-gray-700 [&>h3]:text-[16px] [&>h3]:my-4 [&>h3]:text-gray-800"',
    '<h2>': '<h2 class="text-[18px] font-bold text-gray-800 mb-4">',
    
    'class="spec-table"': 'class="w-full border-collapse group"',
    '<tr><th colspan="2">Key Features</th></tr>': '<tr><th colspan="2" class="bg-[#f2f4f8] text-accent-orange text-[14px] font-semibold py-3 px-4 text-left">Key Features</th></tr>',
    'class="spec-name"': 'class="text-gray-600 w-[30%] py-3 px-4 border-b border-gray-100 text-[14px] align-top"',
    '<td>{{ $spec->value }}</td>': '<td class="py-3 px-4 border-b border-gray-100 text-[14px] align-top">{{ $spec->value }}</td>',
    
    'class="action-header"': 'class="flex justify-between items-start border-b border-gray-100 pb-4 mb-4"',
    'class="action-btn"': 'class="border border-gray-800 text-gray-800 py-2 px-4 rounded text-[13px] font-semibold transition-colors hover:bg-gray-800 hover:text-white"',
    'class="qa-item"': 'class="py-4 border-b border-[#f2f4f8] last:border-b-0"',
    'class="user-meta"': 'class="text-[12px] text-gray-500 mb-2.5"',
    'class="qa-q"': 'class="text-[14px] font-bold text-gray-800 mb-1.5"',
    'class="qa-a"': 'class="text-[14px] text-gray-700"',
    
    'class="review-item"': 'class="py-4 border-b border-[#f2f4f8] last:border-b-0"',
    'class="review-stars mt-2"': 'class="text-[#f59e0b] text-[14px] mt-2 mb-2.5"',
    'class="review-stars"': 'class="text-[#f59e0b] text-[14px] mb-2.5"',
    'class="review-text"': 'class="text-[14px] text-gray-700 mb-2.5 leading-relaxed"',
    
    'class="sidebar"': 'class=""',
    'class="sidebar-card"': 'class="bg-white rounded-lg shadow-sm p-5 text-center"',
    '<h3>Similar Product</h3>': '<h3 class="text-[16px] font-bold text-gray-800 mb-5">Similar Product</h3>',
    'class="similar-list"': 'class=""',
    'class="similar-item"': 'class="flex gap-4 items-center text-left pb-4 mb-4 border-b border-gray-100 last:border-b-0 last:mb-0 last:pb-0"',
    'class="similar-img"': 'class="w-[70px] h-[70px] object-contain shrink-0"',
    'class="similar-info"': 'class=""',
    '<h4><a': '<h4 class="text-[13px] text-gray-800 leading-snug mb-1 [&>a]:transition-colors hover:[&>a]:text-accent-orange"><a',
    'class="similar-price"': 'class="text-[14px] font-bold text-accent-orange mb-2"',
    'class="add-compare-btn"': 'class="text-[12px] text-gray-600 inline-flex items-center gap-1.5 transition-colors hover:text-accent-orange"',
}

for old, new in mappings.items():
    content = content.replace(old, new)

# Handle JS Payment Card toggle to use new classes
content = content.replace("c.classList.remove('active')", "c.classList.remove('active', 'border-accent-blue', 'bg-[#f0f4f9]')")
content = content.replace("card.classList.add('active')", "card.classList.add('active', 'border-accent-blue', 'bg-[#f0f4f9]')")

# Let's fix the section-nav active styling. We can't do arbitrary pseudo elements inline easily without writing them out,
# but Tailwind arbitrary classes work: hover:bg-accent-orange hover:text-white [&.active]:bg-accent-orange [&.active]:text-white
content = re.sub(
    r'<a href="(#.*?)" class="active">', 
    r'<a href="\1" class="active bg-white text-gray-800 py-2.5 px-5 rounded text-[14px] font-semibold shadow-sm transition-colors hover:bg-accent-orange hover:text-white [&.active]:bg-accent-orange [&.active]:text-white">', 
    content
)
content = re.sub(
    r'<a href="(#.*?)">(.*?)</a>', 
    r'<a href="\1" class="bg-white text-gray-800 py-2.5 px-5 rounded text-[14px] font-semibold shadow-sm transition-colors hover:bg-accent-orange hover:text-white [&.active]:bg-accent-orange [&.active]:text-white">\2</a>', 
    content
)

# Fix thumb-images img
content = re.sub(
    r'class="active"(.*?)onclick="switchImage',
    r'class="active w-[70px] h-[70px] border-2 border-gray-200 p-1 rounded cursor-pointer object-contain transition-colors hover:border-accent-orange [&.active]:border-accent-orange"\1onclick="switchImage',
    content
)
content = re.sub(
    r'alt="{{ \$product->name }}"(.*?)onclick="switchImage',
    r'alt="{{ $product->name }}" class="w-[70px] h-[70px] border-2 border-gray-200 p-1 rounded cursor-pointer object-contain transition-colors hover:border-accent-orange [&.active]:border-accent-orange"\1onclick="switchImage',
    content
)

# Fix key-features ul li
content = content.replace(
    '<li><strong>{{ $spec->name }}:</strong>', 
    '<li class="text-[13px] text-gray-600 mb-2 pl-3.5 relative before:content-[\'•\'] before:absolute before:left-0 before:text-accent-orange"><strong>{{ $spec->name }}:</strong>'
)

# Fix qty selector buttons and input
content = content.replace(
    'onclick="changeQty(-1)">−</button>',
    'onclick="changeQty(-1)" class="px-3.5 py-2 bg-gray-50 hover:bg-gray-100 transition-colors cursor-pointer text-[18px] leading-none">−</button>'
)
content = content.replace(
    'onclick="changeQty(1)">+</button>',
    'onclick="changeQty(1)" class="px-3.5 py-2 bg-gray-50 hover:bg-gray-100 transition-colors cursor-pointer text-[18px] leading-none">+</button>'
)
content = content.replace(
    '<input type="number" id="qty"',
    '<input type="number" id="qty" class="w-[50px] text-center border-x border-gray-300 py-2 outline-none"'
)

with open('resources/views/frontend/product/single.blade.php', 'w') as f:
    f.write(content)

