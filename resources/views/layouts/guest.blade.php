<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'TechBlog') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <!-- Logo -->
        <div class="mb-6">
            <a href="/" class="text-3xl font-bold text-blue-600 hover:text-blue-700">
                TechBlog
            </a>
        </div>

        <!-- Auth Card -->
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>

        <!-- Footer Links -->
        <div class="mt-6 text-center">
            <div class="flex items-center justify-center space-x-4 text-sm text-gray-600">
                <a href="{{ route('welcome') }}" class="hover:text-gray-900">Home</a>
                <span>•</span>
                <a href="{{ route('posts.index') }}" class="hover:text-gray-900">Blog</a>
                <span>•</span>
                <a href="#" class="hover:text-gray-900">About</a>
            </div>
            <p class="mt-2 text-xs text-gray-500">
                &copy; {{ date('Y') }} TechBlog. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>
