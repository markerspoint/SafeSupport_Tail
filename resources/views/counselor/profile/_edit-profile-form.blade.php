<form action="{{ route('counselor.profile.update') }}" method="POST" class="space-y-6">
    @csrf
    @method('PUT')
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
        <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" required class="w-full border border-gray-200 rounded-md p-3 text-sm text-gray-600 bg-white focus:ring-gray-300 focus:border-gray-300 transition-colors disabled:bg-gray-100 disabled:text-gray-400">
        @error('name')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" required class="w-full border border-gray-200 rounded-md p-3 text-sm text-gray-600 bg-white focus:ring-gray-300 focus:border-gray-300 transition-colors disabled:bg-gray-100 disabled:text-gray-400">
        @error('email')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
    <div class="mt-6 flex justify-end space-x-3">
        <button type="button" x-on:click="isProfileModal = false" class="inline-flex h-11 items-center px-6 text-sm font-medium text-gray-600 border border-gray-200 rounded-md hover:bg-gray-50 transition-colors">Cancel</button>
        <button type="submit" class="inline-flex h-11 items-center px-6 text-sm font-medium text-white bg-[#171717] rounded-md hover:bg-[#2d2d2d] transition-colors">Save</button>
    </div>
</form>