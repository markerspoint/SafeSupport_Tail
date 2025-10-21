@extends('layout.master-counselor')
@section('title', 'Articles')

@section('body')
<section class="relative pt-[2rem] pb-[2rem] border border-gray-300 rounded-2xl">
    <div class="w-full max-w-7xl mx-auto px-6 lg:px-8 overflow-x-auto">
        <!-- Header -->
        <div class="flex items-center justify-between mb-5">
            <div class="flex items-center gap-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M4 6H20V8H4V6ZM4 10H20V12H4V10ZM4 14H20V16H4V14ZM4 18H20V20H4V18Z" fill="#111827"/>
                </svg>
                <h2 class="text-xl font-semibold text-gray-700">Articles</h2>
            </div>
            <button id="new-article-btn" class="py-2.5 pr-7 pl-5 bg-[#10b981] rounded-xl flex items-center gap-2 text-base font-semibold text-white transition-all duration-300 hover:bg-success-700">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <path d="M10 5V15M15 10H5" stroke="white" stroke-width="1.6" stroke-linecap="round"></path>
                </svg>
                Add Article
            </button>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="mb-4 p-3 bg-emerald-100 text-emerald-800 rounded-md text-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- Articles Table -->
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-700 dark:text-gray-300">
                    <thead class="text-xs text-gray-500 uppercase bg-gray-50 dark:bg-gray-800 dark:text-gray-300">
                        <tr>
                            <th scope="col" class="px-6 py-3">Title</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($articles as $article)
                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700 hover:bg-gray-50 transition cursor-pointer toggle-row" data-id="{{ $article->id }}">
                                <td class="px-6 py-4 flex items-center gap-2">
                                    {{ $article->title }}
                                    <svg class="w-4 h-4 text-gray-500 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full {{ $article->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-gray-100 text-gray-700' }}">
                                        {{ $article->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 flex items-center gap-3">
                                    <button data-id="{{ $article->id }}" class="edit-article-btn text-blue-600 hover:text-blue-800 transition" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    <button data-id="{{ $article->id }}" class="delete-article-btn text-red-600 hover:text-red-800 transition" title="Delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4a1 1 0 011 1v1H9V4a1 1 0 011-1zm-7 4h18" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                            <tr id="expandable-{{ $article->id }}" class="hidden bg-gray-50 dark:bg-gray-800 border-b dark:border-gray-700">
                                <td colspan="3" class="px-6 py-4">
                                    <div class="flex flex-col gap-2">
                                        <div>
                                            <strong class="text-gray-700 dark:text-gray-300">Description:</strong>
                                            <p class="text-gray-600 dark:text-gray-400 description-text line-clamp-2" data-id="{{ $article->id }}" title="{{ $article->description ?? 'N/A' }}">{{ $article->description ?? 'N/A' }}</p>
                                            <button class="toggle-description text-emerald-500 hover:text-emerald-700 text-sm font-medium mt-1" data-id="{{ $article->id }}">Show More</button>
                                        </div>
                                        <div>
                                            <strong class="text-gray-700 dark:text-gray-300">URL:</strong>
                                            <a href="{{ $article->url }}" class="text-emerald-500 hover:underline" target="_blank">{{ Str::limit($article->url, 50) }}</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-8 text-center text-gray-400">
                                    No articles found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Flowbite Modal for Add/Edit Article -->
        <div id="article-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
            <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-900">
                    <div class="flex justify-between items-center p-4 border-b border-gray-200 dark:border-gray-800">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white" id="article-modal-title">Add Article</h3>
                        <button type="button" class="text-gray-400 hover:text-gray-900 dark:hover:text-white" data-modal-hide="article-modal" data-modal-target="article-modal">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <form id="article-form" class="p-4" method="POST">
                        @csrf
                        <input type="hidden" id="article-id" name="id">
                        <div class="mb-4">
                            <label for="article-title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                            <input type="text" id="article-title" name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-success-500 focus:border-success-500 block w-full p-2.5 dark:bg-gray-800 dark:border-gray-700 dark:text-white" required>
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="article-description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <textarea id="article-description" name="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-success-500 focus:border-success-500 block w-full p-2.5 dark:bg-gray-800 dark:border-gray-700 dark:text-white" rows="4"></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="article-url" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">URL</label>
                            <input type="url" id="article-url" name="url" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-success-500 focus:border-success-500 block w-full p-2.5 dark:bg-gray-800 dark:border-gray-700 dark:text-white" required>
                            @error('url')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="flex items-center">
                                <input type="checkbox" id="article-is-active" name="is_active" value="1" checked class="h-4 w-4 text-emerald-500 focus:ring-emerald-500 border-gray-300 rounded">
                                <span class="ml-2 text-sm text-gray-900 dark:text-white">Active</span>
                            </label>
                        </div>
                        <div class="flex items-center gap-3">
                            <button type="submit" id="save-article-btn" class="w-full text-white bg-[#10b981] hover:bg-success-700 focus:ring-4 focus:outline-none focus:ring-success-300 font-medium rounded-lg text-sm px-5 py-2.5">Save</button>
                            <button type="button" id="delete-article-btn" class="hidden w-full text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('style')
<style>
    .custom-shadow {
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const newArticleBtn = document.getElementById('new-article-btn');
        const articleModal = new window.Modal(document.getElementById('article-modal'));
        const articleForm = document.getElementById('article-form');
        const articleIdInput = document.getElementById('article-id');
        const articleTitleInput = document.getElementById('article-title');
        const articleDescriptionInput = document.getElementById('article-description');
        const articleUrlInput = document.getElementById('article-url');
        const articleIsActiveInput = document.getElementById('article-is-active');
        const saveArticleBtn = document.getElementById('save-article-btn');
        const deleteArticleBtn = document.getElementById('delete-article-btn');
        const modalTitle = document.getElementById('article-modal-title');
        const editButtons = document.querySelectorAll('.edit-article-btn');
        const deleteButtons = document.querySelectorAll('.delete-article-btn');
        const toggleRows = document.querySelectorAll('.toggle-row');
        const toggleDescriptionButtons = document.querySelectorAll('.toggle-description');

        const forceBackdropClear = () => {
            document.querySelectorAll('.flowbite-modal-overlay').forEach(backdrop => backdrop.remove());
        };

        // Toggle expandable row
        toggleRows.forEach(row => {
            row.addEventListener('click', (e) => {
                // Prevent toggling when clicking edit/delete buttons or description toggle
                if (e.target.closest('.edit-article-btn') || e.target.closest('.delete-article-btn') || e.target.closest('.toggle-description')) {
                    return;
                }
                const id = row.dataset.id;
                const expandableRow = document.getElementById(`expandable-${id}`);
                expandableRow.classList.toggle('hidden');
                const chevron = row.querySelector('svg');
                if (chevron) chevron.classList.toggle('rotate-180');
            });
        });

        // Toggle description expansion
        toggleDescriptionButtons.forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.stopPropagation(); // Prevent row toggle
                const id = btn.dataset.id;
                const descriptionText = document.querySelector(`.description-text[data-id="${id}"]`);
                descriptionText.classList.toggle('line-clamp-2');
                btn.textContent = descriptionText.classList.contains('line-clamp-2') ? 'Show More' : 'Show Less';
            });
        });

        // Open modal for new article
        newArticleBtn.addEventListener('click', () => {
            articleForm.action = '{{ route("counselor.resources.articles.store") }}';
            articleIdInput.value = '';
            articleTitleInput.value = '';
            articleDescriptionInput.value = '';
            articleUrlInput.value = '';
            articleIsActiveInput.checked = true;
            modalTitle.textContent = 'Add Article';
            saveArticleBtn.textContent = 'Save';
            deleteArticleBtn.classList.add('hidden');
            articleModal.show();
        });

        // Open modal for editing article
        editButtons.forEach(btn => {
            btn.addEventListener('click', async (e) => {
                e.stopPropagation(); // Prevent row toggle
                const id = btn.dataset.id;
                try {
                    const response = await fetch(`{{ url('/counselor/resources/articles') }}/${id}`);
                    const article = await response.json();
                    articleForm.action = `{{ url('/counselor/resources/articles') }}/${id}`;
                    articleForm.method = 'POST';
                    articleForm.innerHTML += '<input type="hidden" name="_method" value="PUT">';
                    articleIdInput.value = id;
                    articleTitleInput.value = article.title;
                    articleDescriptionInput.value = article.description || '';
                    articleUrlInput.value = article.url;
                    articleIsActiveInput.checked = article.is_active;
                    modalTitle.textContent = 'Edit Article';
                    saveArticleBtn.textContent = 'Update';
                    deleteArticleBtn.classList.remove('hidden');
                    articleModal.show();
                } catch (error) {
                    console.error('Error fetching article:', error);
                    alert('Failed to load article.');
                }
            });
        });

        // Delete article
        deleteButtons.forEach(btn => {
            btn.addEventListener('click', async (e) => {
                e.stopPropagation(); // Prevent row toggle
                const id = btn.dataset.id;
                if (confirm('Delete this article?')) {
                    try {
                        const response = await fetch(`{{ url('/counselor/resources/articles') }}/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        });
                        if (response.ok) {
                            window.location.reload();
                        } else {
                            alert('Failed to delete article.');
                        }
                    } catch (error) {
                        console.error('Error deleting article:', error);
                        alert('Failed to delete article.');
                    }
                }
            });
        });

        // Modal close handling
        document.querySelectorAll('[data-modal-hide="article-modal"]').forEach(btn => {
            btn.addEventListener('click', () => {
                articleModal.hide();
                forceBackdropClear();
            });
        });
        document.getElementById('article-modal').addEventListener('click', (e) => {
            if (e.target === document.getElementById('article-modal')) {
                articleModal.hide();
                forceBackdropClear();
            }
        });

        // Delete from modal
        deleteArticleBtn.addEventListener('click', async () => {
            const id = articleIdInput.value;
            if (id && confirm('Delete this article?')) {
                try {
                    const response = await fetch(`{{ url('/counselor/resources/articles') }}/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });
                    if (response.ok) {
                        window.location.reload();
                    } else {
                        alert('Failed to delete article.');
                    }
                } catch (error) {
                    console.error('Error deleting article:', error);
                    alert('Failed to delete article.');
                }
            }
        });
    });
</script>
@endpush