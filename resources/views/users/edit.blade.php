<x-layout title="Edit User">

<div class="max-w-2xl mx-auto mt-10 p-6 bg-white/5 rounded-lg">
    <h2 class="text-2xl font-bold mb-6 text-white">Edit User #{{ $user->id }}</h2>

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-500/20 border border-red-500/50 rounded">
            <ul class="text-red-200">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="/users/{{ $user->id }}" class="space-y-6">
        @csrf
        @method('PATCH')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="first_name" class="block text-sm font-medium text-white mb-2">First Name *</label>
                <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $user->first_name) }}" 
                       class="w-full px-3 py-2 bg-white/10 border border-white/20 rounded-md text-white placeholder-gray-400 focus:outline-none focus:border-indigo-500 @error('first_name') border-red-500 @enderror" 
                       required>
            </div>

            <div>
                <label for="last_name" class="block text-sm font-medium text-white mb-2">Last Name *</label>
                <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $user->last_name) }}" 
                       class="w-full px-3 py-2 bg-white/10 border border-white/20 rounded-md text-white placeholder-gray-400 focus:outline-none focus:border-indigo-500 @error('last_name') border-red-500 @enderror" 
                       required>
            </div>

            <div>
                <label for="middle_name" class="block text-sm font-medium text-white mb-2">Middle Name</label>
                <input type="text" name="middle_name" id="middle_name" value="{{ old('middle_name', $user->middle_name) }}" 
                       class="w-full px-3 py-2 bg-white/10 border border-white/20 rounded-md text-white placeholder-gray-400 focus:outline-none focus:border-indigo-500 @error('middle_name') border-red-500 @enderror">
            </div>

            <div>
                <label for="nickname" class="block text-sm font-medium text-white mb-2">Nickname</label>
                <input type="text" name="nickname" id="nickname" value="{{ old('nickname', $user->nickname) }}" 
                       class="w-full px-3 py-2 bg-white/10 border border-white/20 rounded-md text-white placeholder-gray-400 focus:outline-none focus:border-indigo-500 @error('nickname') border-red-500 @enderror">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-white mb-2">Email *</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" 
                       class="w-full px-3 py-2 bg-white/10 border border-white/20 rounded-md text-white placeholder-gray-400 focus:outline-none focus:border-indigo-500 @error('email') border-red-500 @enderror" 
                       required>
            </div>

            <div>
                <label for="age" class="block text-sm font-medium text-white mb-2">Age</label>
                <input type="number" name="age" id="age" value="{{ old('age', $user->age) }}" min="0"
                       class="w-full px-3 py-2 bg-white/10 border border-white/20 rounded-md text-white placeholder-gray-400 focus:outline-none focus:border-indigo-500 @error('age') border-red-500 @enderror">
            </div>

            <div class="md:col-span-2">
                <label for="address" class="block text-sm font-medium text-white mb-2">Address</label>
                <textarea name="address" id="address" rows="3" class="w-full px-3 py-2 bg-white/10 border border-white/20 rounded-md text-white placeholder-gray-400 focus:outline-none focus:border-indigo-500 @error('address') border-red-500 @enderror">{{ old('address', $user->address) }}</textarea>
            </div>

            <div class="md:col-span-2">
                <label for="contact_number" class="block text-sm font-medium text-white mb-2">Contact Number</label>
                <input type="text" name="contact_number" id="contact_number" value="{{ old('contact_number', $user->contact_number) }}" 
                       class="w-full px-3 py-2 bg-white/10 border border-white/20 rounded-md text-white placeholder-gray-400 focus:outline-none focus:border-indigo-500 @error('contact_number') border-red-500 @enderror">
            </div>
        </div>

        <div class="flex gap-4 pt-4 border-t border-white/10">
            <button type="submit" class="flex-1 bg-green-500 hover:bg-green-600 px-6 py-3 rounded-md text-white font-semibold transition-colors">
                Update User
            </button>
            <a href="/users/{{ $user->id }}" class="flex-1 text-center bg-gray-500 hover:bg-gray-600 px-6 py-3 rounded-md text-white font-semibold transition-colors">
                Cancel
            </a>
        </div>
    </form>
</div>

</x-layout>
