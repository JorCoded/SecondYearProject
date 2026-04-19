<div class="max-w-2xl mx-auto p-6">
    <!-- Profile Card -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- Header with Avatar -->
        <div class="relative h-32 bg-gradient-to-r from-blue-500 to-purple-600">
            <div class="absolute -bottom-16 left-8">
                <div class="relative">
                    <img 
                        src="{{ $currentAvatar }}" 
                        alt="Profile Avatar"
                        class="w-32 h-32 rounded-full border-4 border-white object-cover bg-gray-200"
                    >
                    @if(!$currentAvatar || str_contains($currentAvatar, 'data:image'))
                        <div class="w-32 h-32 rounded-full border-4 border-white absolute inset-0 flex items-center justify-center bg-gray-300">
                            <svg class="w-16 h-16 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Profile Info -->
        <div class="pt-20 pb-6 px-8">
            <h2 class="text-2xl font-bold text-gray-800">{{ $firstname }} {{ $lastname }}</h2>
            <p class="text-gray-500 text-sm">{{ ucfirst($userType) }}</p>
        </div>

        <!-- Form -->
        <div class="border-t border-gray-200 px-8 pb-8">
            <form wire:submit.prevent="save" class="space-y-6">
                <!-- Name Fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="firstname" class="block text-sm font-medium text-gray-700">First Name</label>
                        <input 
                            type="text" 
                            id="firstname"
                            wire:model="firstname"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('firstname') border-red-500 @enderror"
                        >
                        @error('firstname') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="lastname" class="block text-sm font-medium text-gray-700">Last Name</label>
                        <input 
                            type="text" 
                            id="lastname"
                            wire:model="lastname"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('lastname') border-red-500 @enderror"
                        >
                        @error('lastname') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input 
                        type="email" 
                        id="email"
                        wire:model="email"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('email') border-red-500 @enderror"
                    >
                    @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label for="phoneNumber" class="block text-sm font-medium text-gray-700">Phone Number</label>
                    <input 
                        type="text" 
                        id="phoneNumber"
                        wire:model="phoneNumber"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('phoneNumber') border-red-500 @enderror"
                    >
                    @error('phoneNumber') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- Address -->
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                    <textarea 
                        id="address"
                        wire:model="address"
                        rows="2"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('address') border-red-500 @enderror"
                    ></textarea>
                    @error('address') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- Date of Birth -->
                <div>
                    <label for="dob" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                    <input 
                        type="date" 
                        id="dob"
                        wire:model="dob"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('dob') border-red-500 @enderror"
                    >
                    @error('dob') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- Avatar Upload -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Profile Picture</label>
                    <div class="mt-2 flex items-center space-x-4">
                        <input 
                            type="file" 
                            id="avatar"
                            wire:model="avatar"
                            accept="image/*"
                            class="block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-md file:border-0
                                file:text-sm file:font-semibold
                                file:bg-blue-50 file:text-blue-700
                                hover:file:bg-blue-100"
                        >
                        @if($tempAvatar)
                            <img src="{{ $tempAvatar }}" class="w-16 h-16 rounded-full object-cover">
                        @endif
                    </div>
                    @error('avatar') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    @if($currentAvatar && !str_contains($currentAvatar, 'data:image'))
                        <button 
                            type="button"
                            wire:click="deleteAvatar"
                            class="mt-2 text-sm text-red-600 hover:text-red-800"
                        >
                            Remove current avatar
                        </button>
                    @endif
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                    <button 
                        type="button"
                        wire:click="resetToDefaults"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50"
                    >
                        Cancel
                    </button>
                    <div class="flex items-center space-x-4">
                        @if($saved)
                            <span class="text-green-600 text-sm">Saved successfully!</span>
                        @endif
                        <button 
                            type="submit"
                            {{ !$isDirty ? 'disabled' : '' }}
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                            Save Changes
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Flash Messages -->
    @if (session()->has('message'))
        <div class="mt-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mt-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
            {{ session('error') }}
        </div>
    @endif
</div>