@extends('layout.master-counselor')
@section('title', 'Articles')

@section('body')
<div class="max-w-7xl mx-auto p-4">
    <div class="bg-white border border-gray-200 rounded-2xl p-5 custom-shadow transition">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-gray-700 font-semibold text-lg">Articles</h2>
            <button 
                @click="showForm = !showForm" 
                class="bg-emerald-500 text-white px-4 py-1 text-sm font-medium rounded-full transition hover:bg-emerald-600"
            >
                <span x-text="showForm ? 'Cancel' : 'Add Article'"></span>
            </button>
        </div>

        <!-- Form for adding articles -->
        <div x-data="{ showForm: false }" x-show="showForm" class="mb-6">
            <form action="{{ route('counselor.resources.articles.store') }}" method="POST">
                @csrf
                <div class="grid gap-4">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                        <input 
                            type="text" 
                            name="title" 
                            id="title" 
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm" 
                            required
                        >
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea 
                            name="description" 
                            id="description" 
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"
                        ></textarea>
                    </div>
                    <div>
                        <label for="url" class="block text-sm font-medium text-gray-700">URL</label>
                        <input 
                            type="url" 
                            name="url" 
                            id="url" 
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm" 
                            required
                        >
                        @error('url')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="flex items-center">
                            <input 
                                type="checkbox" 
                                name="is_active" 
                                value="1" 
                                checked 
                                class="h-4 w-4 text-emerald-500 focus:ring-emerald-500 border-gray-300 rounded"
                            >
                            <span class="ml-2 text-sm text-gray-700">Active</span>
                        </label>
                    </div>
                    <div>
                        <button 
                            type="submit" 
                            class="bg-emerald-500 text-white px-4 py-2 rounded-full hover:bg-emerald-600 transition sm:text-sm"
                        >
                            Save Article
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Success message -->
        @if (session('success'))
            <div class="mb-4 p-3 bg-emerald-100 text-emerald-800 rounded-md text-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- List of articles -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">URL</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($articles as $article)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-2 text-gray-700">{{ $article->title }}</td>
                            <td class="px-4 py-2 text-gray-700">{{ $article->description ?? 'N/A' }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ $article->url }}" class="text-emerald-500 hover:underline" target="_blank">View</a>
                            </td>
                            <td class="px-4 py-2">
                                <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full shadow-sm {{ $article->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-gray-100 text-gray-700' }}">
                                    {{ $article->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-8 text-center text-gray-400">
                                No articles found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection