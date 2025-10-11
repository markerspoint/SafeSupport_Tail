@extends('layout.master-student')
@section('title', 'Videos')

@section('body')
<div class="bg-pine-50 min-h-full p-6">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-2xl font-bold text-pine-900 mb-4">Videos</h1>
        <div class="bg-white border border-gray-200 rounded-lg p-6">
            @if ($videos->isEmpty())
                <p class="text-gray-600">No videos available.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Link</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($videos as $video)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $video->title }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $video->description ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @if ($video->url)
                                            <a href="{{ $video->url }}" class="text-pine-600 hover:text-pine-900 underline" target="_blank">View Video</a>
                                        @else
                                            <span class="text-gray-400">No link</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection