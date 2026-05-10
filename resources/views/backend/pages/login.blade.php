<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | {{ $setting->app_name ?? 'Iosbd' }}</title>
    @if($setting && $setting->favicon)
        <link rel="icon" href="{{ asset('storage/' . $setting->favicon) }}" type="image/x-icon">
    @endif
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-sm bg-white p-8 border border-gray-200 rounded-lg shadow-sm">
        <div class="text-center mb-8">
            @if ($setting && $setting->logo)
                <img src="{{ asset('storage/' . $setting->logo) }}" alt="{{ $setting->app_name }}" class="h-10 mx-auto mb-4">
            @else
                <img src="https://www.startech.com.bd/image/catalog/logo.png" alt="Star Tech" class="h-10 mx-auto mb-4">
            @endif
            <h5 class="text-xl font-bold text-gray-900">Admin Login</h5>
        </div>

        <form action="{{ route('login') }}" method="POST">
            @csrf

            @if ($errors->any())
                <div class="bg-red-50 text-red-600 p-3 rounded-md mb-4 text-sm font-medium">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="mb-5">
                <label for="email" class="block mb-2 text-sm font-semibold text-gray-700">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}"
                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-accent-orange focus:border-accent-orange block w-full px-3 py-2.5 outline-none transition-all"
                    placeholder="admin@gmail.com" required />
            </div>

            <div class="mb-5">
                <label for="password" class="block mb-2 text-sm font-semibold text-gray-700">Password</label>
                <input type="password" id="password" name="password"
                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-accent-orange focus:border-accent-orange block w-full px-3 py-2.5 outline-none transition-all"
                    placeholder="••••••••" required />
            </div>

            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center">
                    <input id="checkbox-remember" name="remember" type="checkbox"
                        class="w-4 h-4 text-accent-orange border-gray-300 rounded focus:ring-accent-orange">
                    <label for="checkbox-remember" class="ms-2 text-sm font-medium text-gray-600">Remember me</label>
                </div>
            </div>

            <button type="submit"
                class="w-full text-white bg-primary-dark hover:bg-opacity-90 focus:ring-4 focus:outline-none focus:ring-gray-300 font-bold rounded-md text-sm px-5 py-3 transition-all">
                Login to Account
            </button>
        </form>
    </div>

</body>

</html>
