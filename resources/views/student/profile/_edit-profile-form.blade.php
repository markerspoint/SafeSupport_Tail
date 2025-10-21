<div class="space-y-6" x-data="{ selectedAvatar: '{{ old('avatar', auth()->user()->avatar) }}' }">
    <form action="{{ route('student.profile.update') }}" method="POST">
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
        <div>
            <label for="gender" class="block text-sm font-medium text-gray-700 mb-2">Gender</label>
            <select name="gender" id="gender" required class="w-full border border-gray-200 rounded-md p-3 text-sm text-gray-600 bg-white focus:ring-gray-300 focus:border-gray-300 transition-colors">
                <option value="" {{ old('gender', auth()->user()->gender) ? '' : 'selected' }} disabled>Select gender</option>
                <option value="male" {{ old('gender', auth()->user()->gender) === 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ old('gender', auth()->user()->gender) === 'female' ? 'selected' : '' }}>Female</option>
            </select>
            @error('gender')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Select Avatar</label>
            <div class="grid grid-cols-5 gap-3">
                @php
                    $folder = auth()->user()->gender === 'male' ? 'male' : 'female';
                    $avatars = File::files(public_path("img/avatar/{$folder}"));
                @endphp
                @foreach ($avatars as $avatar)
                    <label class="relative cursor-pointer">
                        <input
                            type="radio"
                            name="avatar"
                            value="{{ $avatar->getFilename() }}"
                            x-model="selectedAvatar"
                            class="sr-only"
                            x-on:change="selectedAvatar = '{{ $avatar->getFilename() }}'"
                        >
                        <img
                            src="{{ asset("img/avatar/{$folder}/{$avatar->getFilename()}") }}"
                            alt="Avatar"
                            class="w-full h-10 object-cover rounded-md border transition-all duration-200"
                            :class="selectedAvatar === '{{ $avatar->getFilename() }}' ? 'border-blue-600 border-2 shadow-md' : 'border-gray-200 border hover:border-blue-300'"
                        >
                    </label>
                @endforeach
                @error('avatar')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password (leave blank to keep unchanged)</label>
            <input type="password" name="password" id="password" class="w-full border border-gray-200 rounded-md p-3 text-sm text-gray-600 bg-white focus:ring-gray-300 focus:border-gray-300 transition-colors disabled:bg-gray-100 disabled:text-gray-400">
            @error('password')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="w-full border border-gray-200 rounded-md p-3 text-sm text-gray-600 bg-white focus:ring-gray-300 focus:border-gray-300 transition-colors disabled:bg-gray-100 disabled:text-gray-400">
            @error('password_confirmation')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div class="mt-6 flex justify-end space-x-3">
            <button type="button" x-on:click="isProfileModal = false" class="inline-flex h-11 items-center px-6 text-sm font-medium text-gray-600 border border-gray-200 rounded-md hover:bg-gray-50 transition-colors">Cancel</button>
            <button type="submit" class="inline-flex h-11 items-center px-6 text-sm font-medium text-white bg-[#171717] rounded-md hover:bg-[#2d2d2d] transition-colors">Save</button>
        </div>
    </form>
</div>