<x-layout title="User Details">

<div class="max-w-2xl mx-auto py-10">
    <div class="px-4 sm:px-0">
        <div class="flex justify-between items-start mb-8">
            <div>
                <h2 class="text-3xl font-bold text-white">User Details</h2>
                <p class="text-gray-400 mt-1">#{{ $user->id }}</p>
            </div>
            <div class="space-x-2">
                <a href="/users/{{ $user->id }}/edit" class="bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-md text-white font-semibold">Edit</a>
                <form method="POST" action="/users/{{ $user->id }}" class="inline" onsubmit="return confirm('Delete this user?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-md text-white font-semibold">Delete</button>
                </form>
            </div>
        </div>

        <div class="bg-white/5 rounded-lg p-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-lg font-semibold text-white mb-4">Personal Information</h3>
                    <div class="space-y-3">
                        <p><span class="text-gray-400">Full Name:</span> <span class="font-medium">{{ $user->first_name }} {{ $user->middle_name ? $user->middle_name . ' ' : '' }}{{ $user->last_name }}</span>
                        @if($user->nickname) <span class="text-yellow-400 ml-2">({{ $user->nickname }})</span> @endif</p>
                        <p><span class="text-gray-400">Email:</span> <span class="font-medium">{{ $user->email }}</span></p>
                        <p><span class="text-gray-400">Age:</span> <span class="font-medium">{{ $user->age ?? 'Not specified' }}</span></p>
                        <p><span class="text-gray-400">Address:</span> <span class="font-medium">{{ $user->address ?? 'Not specified' }}</span></p>
                        <p><span class="text-gray-400">Contact:</span> <span class="font-medium">{{ $user->contact_number ?? 'Not specified' }}</span></p>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-white mb-4">Actions</h3>
                    <div class="space-y-3 text-sm">
                        <a href="/users" class="block bg-gray-500 hover:bg-gray-600 px-4 py-2 rounded-md text-white text-center transition-colors">← Back to Users</a>
                        <a href="/users/{{ $user->id }}/edit" class="block bg-indigo-500 hover:bg-indigo-600 px-4 py-2 rounded-md text-white text-center font-semibold transition-colors">Edit User</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</x-layout>
