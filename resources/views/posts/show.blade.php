{{-- resources/views/posts/show.blade.php --}}
@extends('layouts.app')

@section('title', "- {$post->title}")

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Post Header -->
    <article class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
        <div class="p-8">
            <!-- Categories -->
            @if($post->categories->count() > 0)
                <div class="flex flex-wrap gap-2 mb-6">
                    @foreach($post->categories as $category)
                        <a href="{{ route('categories.show', $category) }}"
                           class="inline-block px-3 py-1 text-sm font-medium bg-blue-100 text-blue-800 rounded-full hover:bg-blue-200 transition duration-150 ease-in-out">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            @endif

            <!-- Title -->
            <h1 class="text-4xl font-bold text-gray-900 mb-6 leading-tight">
                {{ $post->title }}
            </h1>

            <!-- Post Meta -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between border-b border-gray-200 pb-6 mb-8">
                <div class="flex items-center space-x-4 mb-4 sm:mb-0">
                    <!-- Author -->
                    <div class="flex items-center space-x-2">
                        <div class="h-10 w-10 bg-blue-500 rounded-full flex items-center justify-center">
                            <span class="text-white font-medium">
                                {{ substr($post->user->name, 0, 1) }}
