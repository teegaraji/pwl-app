@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center">
        <h2 class=" text-3xl font-bold mb-4">Manajemen Tutorial</h2>

        <a href="{{ route('tutorials.create') }}" class=" bg-primary text-white px-4 py-2 rounded mb-4 inline-block">+
            Tambah
            Tutorial</a>
    </div>

    <table class="w-full border border-collapse">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-4 py-2">Judul</th>
                <th class="border px-4 py-2">Kode Matkul</th>
                <th class="border px-4 py-2">Creator</th>
                <th class="border px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tutorials as $tutorial)
                <tr>
                    <td class="border px-4 py-2">{{ $tutorial->title }}</td>
                    <td class="border px-4 py-2">{{ $tutorial->course_code }}</td>
                    <td class="border px-4 py-2">{{ $tutorial->creator_email }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('tutorials.edit', $tutorial->id) }}" class="text-blue-600">Edit</a> |
                        <a href="{{ route('details.index', $tutorial->id) }}" class="text-purple-600">Detail</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
