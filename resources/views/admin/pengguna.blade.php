@extends('layouts.adm')

@section('content')
<div class="ml-64 p-8 bg-gray-50 min-h-screen">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-4">Manajemen Pengguna</h1>
    </div>

    {{-- Tabel Pabrik --}}
    <div class="mb-12">
        <h2 class="text-2xl font-semibold text-blue-600 mb-4">Akun Pabrik</h2>
        <x-tabelpengguna :users="$pabrikUsers" />
    </div>

    {{-- Tabel Petani --}}
    <div>
        <h2 class="text-2xl font-semibold text-green-600 mb-4">Akun Petani</h2>
        <x-tabelpengguna :users="$petaniUsers" />
    </div>
</div>

<!-- Modal Edit -->
<div id="modalEdit" class="fixed inset-0 hidden items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <h2 class="text-xl font-bold mb-4">Edit Pengguna</h2>
        <form id="formEdit">
            @csrf
            <input type="hidden" id="editId">
            <div class="mb-4">
                <label for="editNama" class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" id="editNama" name="name" class="w-full border rounded p-2" required>
            </div>
            <div class="mb-4">
                <label for="editEmail" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="editEmail" name="email" class="w-full border rounded p-2" required>
            </div>
            <div class="flex justify-end">
                <button type="button" id="closeEdit" class="mr-2 text-gray-600 hover:text-gray-800">Batal</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Hapus -->
<div id="modalHapus" class="fixed inset-0 hidden items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <h2 class="text-xl font-bold mb-4 text-red-600">Hapus Pengguna</h2>
        <p class="mb-4">Apakah Anda yakin ingin menghapus pengguna ini?</p>
        <div class="flex justify-end">
            <button type="button" id="closeHapus" class="mr-2 text-gray-600 hover:text-gray-800">Batal</button>
            <button id="btnConfirmHapus" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Hapus</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Tombol Edit
    document.querySelectorAll('.btnEdit').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            const nama = this.dataset.nama;
            const email = this.dataset.email;

            document.getElementById('editId').value = id;
            document.getElementById('editNama').value = nama;
            document.getElementById('editEmail').value = email;
            document.getElementById('modalEdit').classList.remove('hidden');
        });
    });

    // Batal Edit
    document.getElementById('closeEdit').addEventListener('click', function () {
        document.getElementById('modalEdit').classList.add('hidden');
    });

    // Submit Edit
    document.getElementById('formEdit').addEventListener('submit', function (e) {
        e.preventDefault();
        const id = document.getElementById('editId').value;
        const data = {
            name: document.getElementById('editNama').value,
            email: document.getElementById('editEmail').value,
            _token: '{{ csrf_token() }}'
        };

        fetch(`/admin/pengguna/${id}`, {
            method: 'PUT',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(data)
        }).then(res => res.json())
          .then(res => {
              alert(res.message || 'Data berhasil diperbarui.');
              location.reload();
          }).catch(err => {
              alert('Gagal mengedit pengguna.');
              console.error(err);
          });
    });

    // Tombol Hapus
    let userIdToDelete = null;
    document.querySelectorAll('.btnHapus').forEach(btn => {
        btn.addEventListener('click', function () {
            userIdToDelete = this.dataset.id;
            document.getElementById('modalHapus').classList.remove('hidden');
        });
    });

    // Batal Hapus
    document.getElementById('closeHapus').addEventListener('click', function () {
        document.getElementById('modalHapus').classList.add('hidden');
        userIdToDelete = null;
    });

    // Konfirmasi Hapus
    document.getElementById('btnConfirmHapus').addEventListener('click', function () {
        fetch(`/admin/pengguna/${userIdToDelete}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }).then(res => res.json())
          .then(res => {
              alert(res.message || 'Data berhasil dihapus.');
              location.reload();
          }).catch(err => {
              alert('Gagal menghapus pengguna.');
              console.error(err);
          });
    });
});
</script>
@endsection
