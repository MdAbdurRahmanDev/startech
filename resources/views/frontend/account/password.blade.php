@extends('layouts.account')

@section('title', 'Change Password | IOS BD')

@section('breadcrumb_extra')
    <i class="fas fa-chevron-right text-[10px] opacity-30"></i>
    <span class="text-gray-800 font-medium">Change Password</span>
@endsection

@section('account_content')
    <div class="max-w-2xl">
        <!-- Password Update -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-50 flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-orange-50 flex items-center justify-center text-accent-orange">
                    <i class="fas fa-key text-xl"></i>
                </div>
                <h2 class="text-lg font-bold text-primary-dark">Change Password</h2>
            </div>

            <form action="{{ route('user.password.update') }}" method="POST" class="p-6 space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Old Password</label>
                    <div class="relative">
                        <input type="password" name="old_password" id="old_password" placeholder="••••••••"
                            class="w-full bg-gray-50 border @error('old_password') border-red-500 @else border-gray-200 @enderror rounded-xl px-4 py-3 outline-none focus:border-accent-orange transition-all text-sm shadow-sm"
                            required>
                        <button type="button" onclick="togglePassword('old_password', 'old-pass-icon')"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-accent-orange transition-colors">
                            <i id="old-pass-icon" class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('old_password')
                        <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">New Password</label>
                        <div class="relative">
                            <input type="password" name="password" id="password" placeholder="New Password"
                                class="w-full bg-gray-50 border @error('password') border-red-500 @else border-gray-200 @enderror rounded-xl px-4 py-3 outline-none focus:border-accent-orange transition-all text-sm shadow-sm"
                                required>
                            <button type="button" onclick="togglePassword('password', 'new-pass-icon')"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-accent-orange transition-colors">
                                <i id="new-pass-icon" class="fas fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Confirm New Password</label>
                        <div class="relative">
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                placeholder="Confirm"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 outline-none focus:border-accent-orange transition-all text-sm shadow-sm"
                                required>
                            <button type="button" onclick="togglePassword('password_confirmation', 'confirm-pass-icon')"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-accent-orange transition-colors">
                                <i id="confirm-pass-icon" class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <button type="submit"
                    class="bg-accent-orange text-white px-8 py-3 rounded-xl font-bold hover:bg-opacity-90 transition-all shadow-md shadow-orange-100 flex items-center gap-2 group">
                    <span>Update Password</span>
                    <i class="fas fa-shield-alt text-xs group-hover:scale-110 transition-transform"></i>
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
