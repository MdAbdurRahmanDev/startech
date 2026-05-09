@extends('layouts.admin')

@section('title', 'Product Questions')

@section('content')
<div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div>
        <h1 class="text-2xl font-bold text-heading">Product Questions</h1>
        <p class="text-sm text-body">Manage customer inquiries and provide expert answers.</p>
    </div>
</div>

@if(session('success'))
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white border border-default rounded-lg shadow-sm overflow-hidden">
    <table class="w-full text-sm text-left text-body">
        <thead class="text-xs text-heading uppercase bg-neutral-primary-soft border-b border-default">
            <tr>
                <th scope="col" class="px-6 py-4">Product</th>
                <th scope="col" class="px-6 py-4">Question</th>
                <th scope="col" class="px-6 py-4">Customer</th>
                <th scope="col" class="px-6 py-4">Status</th>
                <th scope="col" class="px-6 py-4 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-default">
            @forelse($questions as $question)
                <tr class="hover:bg-neutral-primary-soft transition-colors">
                    <td class="px-6 py-4">
                        <div class="font-bold text-heading truncate max-w-[200px]">{{ $question->product->name }}</div>
                        <div class="text-[10px] text-gray-400">#{{ $question->product->id }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-heading font-medium italic">"{{ Str::limit($question->question, 60) }}"</div>
                        @if($question->answer)
                            <div class="text-[11px] text-green-600 mt-1 font-bold"><i class="fas fa-check-circle mr-1"></i> Answered</div>
                        @else
                            <div class="text-[11px] text-yellow-600 mt-1 font-bold"><i class="fas fa-clock mr-1"></i> Waiting for answer</div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-bold text-heading">{{ $question->name ?? 'Guest User' }}</div>
                        <div class="text-[11px] text-gray-400">{{ $question->created_at->diffForHumans() }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="{{ $question->status ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }} px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">
                            {{ $question->status ? 'Published' : 'Pending' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right space-x-3">
                        <button onclick="document.getElementById('answerModal-{{ $question->id }}').classList.remove('hidden'); document.getElementById('answerModal-{{ $question->id }}').classList.add('flex'); document.body.style.overflow = 'hidden';" class="text-fg-brand hover:underline font-bold text-xs uppercase tracking-wider">Answer / Edit</button>
                        
                        <!-- Answer Modal (Per Row) -->
                        <div id="answerModal-{{ $question->id }}" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/40 backdrop-blur-sm transition-opacity text-left">
                            <div class="bg-white rounded-lg shadow-xl w-full max-w-[600px] overflow-hidden relative mx-4">
                                <div class="bg-primary-dark text-white p-4 font-bold flex justify-between items-center">
                                    <span>Respond to Question</span>
                                    <button onclick="document.getElementById('answerModal-{{ $question->id }}').classList.add('hidden'); document.getElementById('answerModal-{{ $question->id }}').classList.remove('flex'); document.body.style.overflow = 'auto';" class="text-white hover:text-gray-300"><i class="fas fa-times"></i></button>
                                </div>
                                <div class="p-6">
                                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Customer Question:</p>
                                    <p class="text-heading font-medium italic bg-neutral-primary-soft p-4 rounded-lg mb-6 border border-default whitespace-normal">"{{ $question->question }}"</p>
                                    
                                    <form action="{{ route('admin.questions.update', $question->id) }}" method="POST" class="space-y-6">
                                        @csrf
                                        <div>
                                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Expert Answer</label>
                                            <textarea name="answer" rows="5" required class="w-full bg-gray-50 border border-gray-200 rounded-lg py-3 px-4 focus:border-fg-brand outline-none transition-all text-sm">{{ $question->answer }}</textarea>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Display Status</label>
                                            <select name="status" class="w-full bg-gray-50 border border-gray-200 rounded-lg py-3 px-4 focus:border-fg-brand outline-none transition-all text-sm font-bold">
                                                <option value="0" {{ $question->status == 0 ? 'selected' : '' }} class="text-yellow-600">Hidden (Pending Review)</option>
                                                <option value="1" {{ $question->status == 1 ? 'selected' : '' }} class="text-green-600">Approved (Visible on Website)</option>
                                            </select>
                                            <p class="text-[10px] text-gray-400 mt-1 italic text-left">Only approved questions with answers will be shown to customers.</p>
                                        </div>
                                        <div class="flex justify-end gap-3 pt-4 border-t border-default">
                                            <button type="button" onclick="document.getElementById('answerModal-{{ $question->id }}').classList.add('hidden'); document.getElementById('answerModal-{{ $question->id }}').classList.remove('flex'); document.body.style.overflow = 'auto';" class="px-6 py-2 rounded-lg text-sm font-bold bg-gray-100 text-gray-600 hover:bg-gray-200">Cancel</button>
                                            <button type="submit" class="px-6 py-2 rounded-lg text-sm font-bold bg-fg-brand text-white hover:shadow-lg transition-all">Save Response</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('admin.questions.destroy', $question->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this question?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                        No product questions found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $questions->links() }}
</div>

<!-- Answer Modal -->
<div id="answerModal" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/40 backdrop-blur-sm transition-opacity">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-[600px] overflow-hidden relative mx-4">
        <div class="bg-primary-dark text-white p-4 font-bold flex justify-between items-center">
            <span>Respond to Question</span>
            <button onclick="closeAnswerModal()" class="text-white hover:text-gray-300"><i class="fas fa-times"></i></button>
        </div>
        <div class="p-6">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Customer Question:</p>
            <p id="modalQuestionText" class="text-heading font-medium italic bg-neutral-primary-soft p-4 rounded-lg mb-6 border border-default"></p>
            
            <form id="answerForm" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Expert Answer</label>
                    <textarea name="answer" id="modalAnswerText" rows="5" required class="w-full bg-gray-50 border border-gray-200 rounded-lg py-3 px-4 focus:border-fg-brand outline-none transition-all text-sm"></textarea>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Display Status</label>
                    <select name="status" id="modalStatus" class="w-full bg-gray-50 border border-gray-200 rounded-lg py-3 px-4 focus:border-fg-brand outline-none transition-all text-sm font-bold">
                        <option value="0" class="text-yellow-600">Hidden (Pending Review)</option>
                        <option value="1" class="text-green-600">Approved (Visible on Website)</option>
                    </select>
                    <p class="text-[10px] text-gray-400 mt-1 italic">Only approved questions with answers will be shown to customers.</p>
                </div>
                <div class="flex justify-end gap-3 pt-4 border-t border-default">
                    <button type="button" onclick="closeAnswerModal()" class="px-6 py-2 rounded-lg text-sm font-bold bg-gray-100 text-gray-600 hover:bg-gray-200">Cancel</button>
                    <button type="submit" class="px-6 py-2 rounded-lg text-sm font-bold bg-fg-brand text-white hover:shadow-lg transition-all">Save Response</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    function openAnswerModal(id, question, answer, status) {
        document.getElementById('modalQuestionText').innerText = question;
        document.getElementById('modalAnswerText').value = answer || '';
        document.getElementById('modalStatus').value = status;
        document.getElementById('answerForm').action = `/admin/questions/${id}`;
        
        const modal = document.getElementById('answerModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeAnswerModal() {
        const modal = document.getElementById('answerModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = 'auto';
    }
</script>
@endsection
