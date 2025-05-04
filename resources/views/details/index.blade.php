@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Daftar Detail Tutorial: {{ $tutorial->title }}</h2>

    <div class="flex justify-between items-center mb-4">
        <a href="{{ route('details.create', $tutorial->id) }}"
            class="bg-blue-500 text-white px-4 py-2 rounded-md inline-block">+ Tambah Detail</a>

        <div>
            <a href="{{ $tutorial->url_presentation }}" target="_blank"
                class=" hover:bg-yellow-600 bg-yellow-500 rounded-md px-4 py-2  inline-block text-white">Presentation</a>

            <a href="{{ $tutorial->url_finished }}" target="_blank"
                class="  hover:bg-purple-800 bg-purple-600  rounded-md px-4 py-2 inline-block text-white">Finished</a>
        </div>
    </div>

    <table class="min-w-full bg-primary border-2 shadow-md rounded-lg overflow-hidden">
        <thead class="bg-primary">
            <tr>
                <th class="py-3 w-20 text-center border">Urutan</th>
                <th class="p-3 w-auto text-center border">Teks</th>
                <th class="py-3 w-40 text-center border">Status</th>
                <th class="py-3 w-40 text-center border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($details as $detail)
                <tr class="border-t">
                    <td class="px-3 py-2 border text-center">{{ $detail->order }}</td>
                    <td class="px-3 py-2 border">{{ \Str::limit($detail->text, 70) }}</td>
                    <td class="px-3 py-2 border text-center">
                        <form
                            action="{{ route('details.updateStatus', ['tutorial' => $tutorial->id, 'detail' => $detail->id]) }}"
                            method="POST">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="w-full p-2 bg-primary text-white rounded"
                                onchange="this.form.submit()">
                                <option value="show" {{ $detail->status == 'show' ? 'selected' : '' }}>Show</option>
                                <option value="hide" {{ $detail->status == 'hide' ? 'selected' : '' }}>Hide</option>
                            </select>
                        </form>


                    </td>
                    <td class="px-3 py-2 border text-center">
                        {{-- Tautan Edit --}}
                        <a href="{{ route('details.edit', ['tutorial' => $tutorial->id, 'detail' => $detail->id]) }}"
                            class="text-blue-600 px-2 py-1 mb-2 rounded-lg hover:bg-blue-600 hover:text-white">Edit</a>

                        {{-- Formulir Hapus --}}
                        <form
                            action="{{ route('details.destroy', ['tutorial' => $tutorial->id, 'detail' => $detail->id]) }}"
                            method="POST" class="inline-block" onsubmit="return confirm('Yakin hapus detail ini?')">
                            @csrf
                            @method('DELETE')
                            <button
                                class="text-red-600 cursor-pointer px-2 py-1 rounded-lg hover:bg-red-600 hover:text-white">Hapus</button>
                        </form>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
