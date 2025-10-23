@extends('layout.master-student')
@section('title', 'Videos')

@section('body')
<div class="bg-pine-50 min-h-full p-6 border border-gray-300 rounded-2xl">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-2xl font-bold text-gray-700 mb-4">
            <span class="flex items-center gap-3">
                <svg class="w-6 h-6 text-pine-700" viewBox="0 0 24 24" fill="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                <path d="M3 7a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v3l4-3v10l-4-3v3a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7z" fill="currentColor"/>
                </svg>

                <span>Videos</span>
            </span>

         <span class="block text-sm text-gray-500 font-normal mt-1">Browse tutorials and recorded sessions</span>
        </h1>


        <hr class="text-gray-600 mb-4">

        @if ($videos->isEmpty())
            <div class="bg-white border border-gray-200 rounded-lg p-6 text-center">
                <p class="text-gray-600">No videos available.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($videos as $video)
                    @php
                        $youtubeId = null;
                        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $video->url, $match)) {
                            $youtubeId = $match[1];
                        }
                        $youtubeUrl = $youtubeId ? 'https://www.youtube.com/watch?v=' . $youtubeId : ($video->url ?? '');
                    @endphp

                    <div class="bg-white border border-gray-200 rounded-lg shadow-md hover:scale-101 transition-transform duration-300">
                        <div class="aspect-video bg-gray-200 flex items-center justify-center">
                            @if($youtubeId)
                                <img src="https://img.youtube.com/vi/{{ $youtubeId }}/hqdefault.jpg" alt="{{ $video->title }}" class="w-full h-full object-cover">
                            @else
                                <img src="https://via.placeholder.com/380x213" alt="{{ $video->title }}" class="w-full h-full object-cover">
                            @endif
                        </div>
                        <div class="p-4">
                            <h2 class="text-lg font-semibold text-gray-900 mb-2">{{ $video->title }}</h2>
                            <p class="text-sm text-gray-600 mb-4">{{ $video->description ?? 'No description available' }}</p>
                            @if($youtubeId)
                            <button onclick="openVideoModal('{{ addslashes($video->title) }}', '{{ $youtubeId }}', '{{ $youtubeUrl }}')" class="w-full bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700 transition-colors duration-200">
                                View Video
                            </button>
                            @else
                            <a href="{{ $youtubeUrl }}" target="_blank" class="w-full block text-center bg-gray-600 text-white py-2 px-4 rounded-lg hover:bg-gray-700 transition-colors duration-200">
                                Open Link
                            </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Video Modal -->
    <div id="videoModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-4xl relative">
            <button onclick="closeVideoModal()" class="absolute top-4 right-4 text-gray-600 hover:text-gray-900">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6 6 18" />
                    <path d="m6 6 12 12" />
                </svg>
            </button>
            <h2 id="videoModalTitle" class="text-xl font-bold text-gray-900 mb-4"></h2>

            <div id="videoModalBody" class="aspect-video relative bg-gray-200 rounded-lg">
                <div id="player" class="w-full h-full rounded-lg"></div>
                <div id="videoErrorOverlay" class="hidden absolute inset-0 bg-black bg-opacity-75 flex flex-col items-center justify-center text-white text-center px-4 rounded-lg">
                    <p class="mb-4">This video cannot be played directly.</p>
                    <a id="videoErrorLink" href="#" target="_blank" class="underline text-green-400 font-semibold">Open on YouTube</a>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <button onclick="closeVideoModal()" class="px-4 py-2 text-sm font-medium text-gray-600 border border-gray-200 rounded-lg hover:bg-gray-100">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://www.youtube.com/iframe_api"></script>
<script>
let player;
let currentVideoId = null;

function onYouTubeIframeAPIReady() {
    player = new YT.Player('player', {
        height: '100%',
        width: '100%',
        videoId: '',
        events: {
            'onReady': function(event){},
            'onError': function(event){
                document.getElementById('videoErrorOverlay').classList.remove('hidden');
            }
        },
        playerVars: {
            rel: 0,
            modestbranding: 1
        }
    });
}

function openVideoModal(title, youtubeId, youtubeUrl) {
    document.getElementById('videoModalTitle').textContent = title;
    document.getElementById('videoErrorOverlay').classList.add('hidden');
    document.getElementById('videoErrorLink').href = youtubeUrl;

    if (player && youtubeId !== currentVideoId) {
        currentVideoId = youtubeId;
        player.loadVideoById(youtubeId);
    }

    document.getElementById('videoModal').classList.remove('hidden');
}

function closeVideoModal() {
    document.getElementById('videoModal').classList.add('hidden');
    if (player) player.stopVideo();
}

document.addEventListener('keydown', (e) => {
    if (e.key === "Escape") closeVideoModal();
});
</script>
@endpush
