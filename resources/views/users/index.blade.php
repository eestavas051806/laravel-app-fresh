<x-layout title="Users List">

<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold text-white">Users</h2>
            <a href="/users/create" class="bg-blue-500 hover:bg-blue-600 px-6 py-2 rounded-md text-white font-semibold transition-colors">+ Add New User</a>
        </div>

        @if (session('success'))
            <div class="mb-6 p-4 bg-green-500/20 border border-green-500/50 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if ($users->count() > 0)
            <div class="overflow-x-auto bg-white/5 rounded-lg">
                <table class="min-w-full divide-y divide-white/10">
                    <thead class="bg-white/10">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Full Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Age</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Contact</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white/5 divide-y divide-white/10">
                        @foreach($users as $user)
                        <tr class="hover:bg-white/10 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-white font-medium">{{ $user->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
                                {{ $user->first_name }} {{ $user->middle_name ? $user->middle_name.' ' : '' }}{{ $user->last_name }}
                                @if($user->nickname) <span class="text-gray-400">({{ $user->nickname }})</span> @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-white">{{ $user->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-white">{{ $user->age ?? 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-white">{{ $user->contact_number ?? 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <a href="/users/{{ $user->id }}" class="text-indigo-400 hover:text-indigo-300">View</a>
                                <a href="/users/{{ $user->id }}/edit" class="text-blue-400 hover:text-blue-300">Edit</a>
                                
                                <form method="POST" action="/users/{{ $user->id }}" class="inline" onsubmit="return confirm('Delete this user?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-300">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-xl text-gray-400 mb-4">No users found.</p>
                <a href="/users/create" class="bg-blue-500 hover:bg-blue-600 px-6 py-2 rounded-md text-white font-semibold">Create First User</a>
            </div>
        @endif
    </div>
</div>

</x-layout>
