{{-- resources/views/templateadmin/index.blade.php --}}
@extends('layout.nc')

@section('title', 'Manajemen Template')

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-bold mb-2">Template Admin</h1>
        <p class="text-gray-600">Kelola semua template yang tersedia</p>
    </div>

    <div class="mb-4 text-right">
        <a href="{{ route('templateadmin.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Tambah Template</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full table-auto text-sm text-left">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3">File</th>
                    <th class="px-4 py-3">Dibuat Oleh</th>
                    <th class="px-4 py-3">Dibuat Pada</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @foreach ($templates as $template)
                    <tr>
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3">{{ $template->name }}</td>
                        <td class="px-4 py-3">
                            @if (in_array(pathinfo($template->file_path, PATHINFO_EXTENSION), ['jpg','jpeg','png','gif']))
                                <img src="{{ Storage::url($template->file_path) }}" class="w-20 rounded shadow">
                            @else
                                <a href="{{ asset('storage/'.$template->file_path) }}" target="_blank" class="text-blue-600 underline">Lihat File</a>
                            @endif
                        </td>
                        <td class="px-4 py-3">{{ $template->user->name ?? 'Tidak diketahui' }}</td>
                        <td class="px-4 py-3">{{ $template->created_at->format('d M Y') }}</td>
                        <td class="px-4 py-3 space-x-2">
                            <a href="{{ route('templateadmin.edit', $template->id) }}" class="text-yellow-600 hover:underline">Edit</a>
                            <form action="{{ route('templateadmin.destroy', $template->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection