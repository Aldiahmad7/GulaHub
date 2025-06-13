<div class="bg-white rounded-xl shadow border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Nama</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Email</th>
                    <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($users as $user)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">{{ $user->name }}</td>
                        <td class="px-6 py-4">{{ $user->email }}</td>
                        <td class="px-6 py-4 text-center">
                            <button class="btnEdit text-blue-600 hover:text-blue-800" data-id="{{ $user->id }}" data-nama="{{ $user->name }}" data-email="{{ $user->email }}">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btnHapus text-red-600 hover:text-red-800 ml-2" data-id="{{ $user->id }}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
