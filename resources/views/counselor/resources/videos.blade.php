@extends('layout.master-counselor')
@section('title', 'Videos')

@section('body')
<div class="max-w-7xl mx-auto p-4">
    <div class="bg-white border border-gray-200 rounded-2xl p-5 custom-shadow transition">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-gray-700 font-semibold text-lg">Videos</h2>
            <button onclick="document.getElementById('add-video-modal').classList.remove('hidden')" class="bg-emerald-500 text-white p-2 rounded-full transition hover:bg-emerald-600 flex items-center gap-2">
                <img src="{{ asset('img/icons/plus-circle.svg') }}" class="w-5 h-5" alt="Add">
                <span class="text-sm font-medium">Add Video</span>
            </button>
        </div>

        <!-- Success message -->
        @if (session('success'))
        <div class="mb-4 p-3 bg-emerald-100 text-emerald-800 rounded-md text-sm">
            {{ session('success') }}
        </div>
        @endif

        <hr class="mb-4">

        <!-- List of videos as cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($videos as $video)
            <div class="rounded-lg overflow-hidden border border-neutral-200/60 bg-white text-neutral-700 shadow-sm w-full">
                <div class="relative">
                    @php
                    // Extract YouTube video ID from URL
                    $youtubeId = null;
                    if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $video->url, $match)) {
                    $youtubeId = $match[1];
                    }
                    @endphp
                    <img src="{{ $youtubeId ? 'https://img.youtube.com/vi/' . $youtubeId . '/hqdefault.jpg' : 'https://via.placeholder.com/380x213' }}" class="w-full h-auto" alt="{{ $video->title }}" />
                    <span class="absolute top-2 right-2 inline-block px-3 py-1 text-xs font-semibold rounded-full shadow-sm {{ $video->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-gray-100 text-gray-700' }}">
                        {{ $video->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>
                <div class="p-5">
                    <h2 class="mb-2 text-lg font-bold leading-none tracking-tight">{{ $video->title }}</h2>

                    <div x-data="{ expanded: false }" class="text-sm text-neutral-600">
                        <p x-bind:class="expanded ? 'line-clamp-none' : 'line-clamp-2'" class="mb-2 transition-all duration-300">
                            {{ $video->description ?? 'No description available' }}
                        </p>

                        @if(!empty($video->description) && strlen($video->description) > 100)
                        <div class="flex justify-center">
                            <button @click="expanded = !expanded" x-text="expanded ? 'Read less' : 'Read more'" class="text-gray-600 hover:underline text-xs font-medium focus:outline-none"></button>
                        </div>
                        @endif

                    </div>


                    <a href="{{ $video->url }}" target="_blank" class="inline-flex items-center justify-center w-full h-10 px-4 py-2 text-sm font-medium text-white transition-colors rounded-md focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500 focus-visible:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-emerald-500 hover:bg-emerald-600">View Video</a>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center text-gray-400 py-8">
                No videos found
            </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Add Video Modal -->
<div id="add-video-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 transition-opacity duration-300 hidden">
    <div class="bg-white rounded-lg shadow-lg max-w-lg w-full p-6 transform transition-transform duration-300">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-700">Add New Video</h3>
            <button onclick="document.getElementById('add-video-modal').classList.add('hidden')" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <form action="{{ route('counselor.resources.videos.store') }}" method="POST">
            @csrf
            <div class="grid gap-4">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" name="title" id="title" class="mt-1 block w-full border border-gray-400 p-2 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm" required>
                    @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" class="mt-1 block w-full border border-gray-400 p-2 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"></textarea>
                </div>
                <div>
                    <label for="url" class="block text-sm font-medium text-gray-700">URL</label>
                    <input type="url" name="url" id="url" class="mt-1 block w-full border border-gray-400 p-2 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm" required>
                    @error('url')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                {{-- <div>
                    <label class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" checked class="h-4 w-4 text-emerald-500 focus:ring-emerald-500 border-gray-300 rounded">
                        <span class="ml-2 text-sm text-gray-700">Active</span>
                    </label>
                </div> --}}
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="document.getElementById('add-video-modal').classList.add('hidden')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">Cancel</button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-emerald-500 rounded-md hover:bg-emerald-600 flex items-center gap-2">
                        <img src="{{ asset('img/icons/save.svg') }}" class="w-5 h-5" alt="Save">
                        <span>Save Video</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    // Ensure modal is hidden on page load
    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('add-video-modal').classList.add('hidden');
    });

</script>
@endsection
