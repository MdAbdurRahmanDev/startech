@extends('layouts.account')

@section('title', 'Edit Profile | IOS BD')

@section('breadcrumb_extra')
    <i class="fas fa-chevron-right text-[10px] opacity-30"></i>
    <span class="text-gray-800 font-medium">Edit Profile</span>
@endsection

@section('account_content')
    <div class="max-w-2xl">
        <!-- Personal Details -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-50 flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600">
                    <i class="fas fa-user-circle text-xl"></i>
                </div>
                <h2 class="text-lg font-bold text-primary-dark">Personal Details</h2>
            </div>

            <form action="{{ route('user.profile.update') }}" method="POST" class="p-6 space-y-5">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">First Name <span
                                class="text-accent-orange">*</span></label>
                        <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}"
                            class="w-full bg-gray-50 border @error('first_name') border-red-500 @else border-gray-200 @enderror rounded-xl px-4 py-3 outline-none focus:border-accent-orange transition-all text-sm shadow-sm"
                            required>
                        @error('first_name')
                            <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Last Name <span
                                class="text-accent-orange">*</span></label>
                        <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}"
                            class="w-full bg-gray-50 border @error('last_name') border-red-500 @else border-gray-200 @enderror rounded-xl px-4 py-3 outline-none focus:border-accent-orange transition-all text-sm shadow-sm"
                            required>
                        @error('last_name')
                            <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">E-Mail Address <span
                            class="text-accent-orange">*</span></label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                        class="w-full bg-gray-50 border @error('email') border-red-500 @else border-gray-200 @enderror rounded-xl px-4 py-3 outline-none focus:border-accent-orange transition-all text-sm shadow-sm"
                        required>
                    @error('email')
                        <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Telephone <span
                            class="text-accent-orange">*</span></label>
                    <input type="text" name="telephone" value="{{ old('telephone', $user->phone) }}"
                        class="w-full bg-gray-50 border @error('telephone') border-red-500 @else border-gray-200 @enderror rounded-xl px-4 py-3 outline-none focus:border-accent-orange transition-all text-sm shadow-sm"
                        required>
                    @error('telephone')
                        <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="bg-primary-dark text-white px-8 py-3 rounded-xl font-bold hover:bg-opacity-90 transition-all shadow-md shadow-blue-100 flex items-center gap-2 group">
                    <span>Save Changes</span>
                    <i class="fas fa-check text-xs group-hover:scale-110 transition-transform"></i>
                </button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
@endsection
