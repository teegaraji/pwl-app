@extends('layouts.app')

@section('content')
    <table class="w-full border border-collapse">
        <thead>
            <tr class="bg-secondary text-primary">
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
                    <td class="border py-2 text-center">
                        <a href="{{ route('tutorials.edit', $tutorial->id) }}"
                            class="text-blue-600  px-2 py-1 rounded-lg hover:bg-blue-600 hover:text-white">Edit</a> |
                        <a href="{{ route('details.index', $tutorial->id) }}"
                            class="text-purple-600 px-2 py-1 rounded-lg hover:bg-purple-600 hover:text-white">Detail</a> |
                        <form action="{{ route('tutorials.destroy', $tutorial->id) }}" method="POST" class="inline"
                            onsubmit="return confirm('Yakin hapus detail ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="text-red-600 cursor-pointer px-2 py-1 rounded-lg hover:bg-red-600 hover:text-white">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
