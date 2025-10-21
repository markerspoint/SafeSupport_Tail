@extends('layout.master-counselor')
@section('title', 'Self-Help Tools')

@section('body')
<section class="relative pt-[2rem] pb-[2rem] border border-gray-300 rounded-2xl">
    <div class="w-full max-w-7xl mx-auto px-6 lg:px-8 overflow-x-auto">
        <!-- Header -->
        <div class="flex items-center justify-between mb-5">
            <div class="flex items-center gap-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M4 6H20V8H4V6ZM4 10H20V12H4V10ZM4 14H20V16H4V14ZM4 18H20V20H4V18Z" fill="#111827"/>
                </svg>
                <h2 class="text-xl font-semibold text-gray-700">Self-Help Tools</h2>
            </div>
            <button id="new-tool-btn" class="py-2.5 pr-7 pl-5 bg-[#10b981] rounded-xl flex items-center gap-2 text-base font-semibold text-white transition-all duration-300 hover:bg-success-700">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <path d="M10 5V15M15 10H5" stroke="white" stroke-width="1.6" stroke-linecap="round"></path>
                </svg>
                Add Self-Help Tool
            </button>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="mb-4 p-3 bg-emerald-100 text-emerald-800 rounded-md text-sm">
                {{ session('success') }}
            </div>
        @endif

    <!-- Self-Help Tools Table -->
    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-700 dark:text-gray-300">
                <thead class="text-xs text-gray-500 uppercase bg-gray-50 dark:bg-gray-800 dark:text-gray-300">
                    <tr>
                        <th scope="col" class="px-6 py-3">Name</th>
                        <th scope="col" class="px-6 py-3">Description</th>
                        <th scope="col" class="px-6 py-3">URL</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($selfHelps as $tool)
                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700 hover:bg-gray-50 transition">
                            <td class="px-6 py-4">{{ $tool->title }}</td>
                            <td class="px-6 py-4 line-clamp-2">{{ $tool->description ?? 'N/A' }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ $tool->url }}" class="text-emerald-500 hover:underline" target="_blank">{{ Str::limit($tool->url, 30) }}</a>
                            </td>
                            <td class="px-6 py-4">{{ $tool->is_active ? 'Active' : 'Inactive' }}</td>
                            <td class="px-6 py-4 flex items-center gap-3">
                                <button data-id="{{ $tool->id }}" class="edit-tool-btn text-blue-600 hover:text-blue-800 transition" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                                <button data-id="{{ $tool->id }}" class="delete-tool-btn text-red-600 hover:text-red-800 transition" title="Delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4a1 1 0 011 1v1H9V4a1 1 0 011-1zm-7 4h18" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-400">
                                No self-help tools found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

        <!-- Flowbite Modal for Add/Edit Self-Help Tool -->
        <div id="tool-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
            <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-900">
                    <div class="flex justify-between items-center p-4 border-b border-gray-200 dark:border-gray-800">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white" id="tool-modal-title">Add Self-Help Tool</h3>
                        <button type="button" class="text-gray-400 hover:text-gray-900 dark:hover:text-white" data-modal-hide="tool-modal" data-modal-target="tool-modal">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <form id="tool-form" class="p-4" method="POST">
                        @csrf
                        <input type="hidden" id="tool-id" name="id">
                        <div class="mb-4">
                            <label for="tool-title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                            <input type="text" id="tool-title" name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-success-500 focus:border-success-500 block w-full p-2.5 dark:bg-gray-800 dark:border-gray-700 dark:text-white" required>
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="tool-description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <textarea id="tool-description" name="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-success-500 focus:border-success-500 block w-full p-2.5 dark:bg-gray-800 dark:border-gray-700 dark:text-white" rows="4"></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="tool-url" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">URL</label>
                            <input type="url" id="tool-url" name="url" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-success-500 focus:border-success-500 block w-full p-2.5 dark:bg-gray-800 dark:border-gray-700 dark:text-white" required>
                            @error('url')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="flex items-center">
                                <input type="checkbox" id="tool-is-active" name="is_active" value="1" checked class="h-4 w-4 text-emerald-500 focus:ring-emerald-500 border-gray-300 rounded">
                                <span class="ml-2 text-sm text-gray-900 dark:text-white">Active</span>
                            </label>
                        </div>
                        <div class="flex items-center gap-3">
                            <button type="submit" id="save-tool-btn" class="w-full text-white bg-[#10b981] hover:bg-success-700 focus:ring-4 focus:outline-none focus:ring-success-300 font-medium rounded-lg text-sm px-5 py-2.5">Save</button>
                            <button type="button" id="delete-tool-btn" class="hidden w-full text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5">Delete</button>
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
        const newToolBtn = document.getElementById('new-tool-btn');
        const toolModal = new window.Modal(document.getElementById('tool-modal'));
        const toolForm = document.getElementById('tool-form');
        const toolIdInput = document.getElementById('tool-id');
        const toolTitleInput = document.getElementById('tool-title');
        const toolDescriptionInput = document.getElementById('tool-description');
        const toolUrlInput = document.getElementById('tool-url');
        const toolIsActiveInput = document.getElementById('tool-is-active');
        const saveToolBtn = document.getElementById('save-tool-btn');
        const deleteToolBtn = document.getElementById('delete-tool-btn');
        const modalTitle = document.getElementById('tool-modal-title');
        const editButtons = document.querySelectorAll('.edit-tool-btn');
        const deleteButtons = document.querySelectorAll('.delete-tool-btn');

        const forceBackdropClear = () => {
            document.querySelectorAll('.flowbite-modal-overlay').forEach(backdrop => backdrop.remove());
        };

        // Open modal for new self-help tool
        newToolBtn.addEventListener('click', () => {
            toolForm.action = '{{ route("counselor.resources.self-help.store") }}';
            toolIdInput.value = '';
            toolTitleInput.value = '';
            toolDescriptionInput.value = '';
            toolUrlInput.value = '';
            toolIsActiveInput.checked = true;
            modalTitle.textContent = 'Add Self-Help Tool';
            saveToolBtn.textContent = 'Save';
            deleteToolBtn.classList.add('hidden');
            toolModal.show();
        });

        // Open modal for editing self-help tool
        editButtons.forEach(btn => {
            btn.addEventListener('click', async () => {
                const id = btn.dataset.id;
                try {
                    const response = await fetch(`{{ url('/counselor/resources/self-help') }}/${id}`);
                    const tool = await response.json();
                    toolForm.action = `{{ url('/counselor/resources/self-help') }}/${id}`;
                    toolForm.method = 'POST';
                    toolForm.innerHTML += '<input type="hidden" name="_method" value="PUT">';
                    toolIdInput.value = id;
                    toolTitleInput.value = tool.title;
                    toolDescriptionInput.value = tool.description || '';
                    toolUrlInput.value = tool.url;
                    toolIsActiveInput.checked = tool.is_active;
                    modalTitle.textContent = 'Edit Self-Help Tool';
                    saveToolBtn.textContent = 'Update';
                    deleteToolBtn.classList.remove('hidden');
                    toolModal.show();
                } catch (error) {
                    console.error('Error fetching self-help tool:', error);
                    alert('Failed to load self-help tool.');
                }
            });
        });

        // Delete self-help tool
        deleteButtons.forEach(btn => {
            btn.addEventListener('click', async () => {
                const id = btn.dataset.id;
                if (confirm('Delete this self-help tool?')) {
                    try {
                        const response = await fetch(`{{ url('/counselor/resources/self-help') }}/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        });
                        if (response.ok) {
                            window.location.reload();
                        } else {
                            alert('Failed to delete self-help tool.');
                        }
                    } catch (error) {
                        console.error('Error deleting self-help tool:', error);
                        alert('Failed to delete self-help tool.');
                    }
                }
            });
        });

        // Modal close handling
        document.querySelectorAll('[data-modal-hide="tool-modal"]').forEach(btn => {
            btn.addEventListener('click', () => {
                toolModal.hide();
                forceBackdropClear();
            });
        });
        document.getElementById('tool-modal').addEventListener('click', (e) => {
            if (e.target === document.getElementById('tool-modal')) {
                toolModal.hide();
                forceBackdropClear();
            }
        });

        // Delete from modal
        deleteToolBtn.addEventListener('click', async () => {
            const id = toolIdInput.value;
            if (id && confirm('Delete this self-help tool?')) {
                try {
                    const response = await fetch(`{{ url('/counselor/resources/self-help') }}/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });
                    if (response.ok) {
                        window.location.reload();
                    } else {
                        alert('Failed to delete self-help tool.');
                    }
                } catch (error) {
                    console.error('Error deleting self-help tool:', error);
                    alert('Failed to delete self-help tool.');
                }
            }
        });
    });
</script>
@endpush