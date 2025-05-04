@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Tambah Detail Tutorial</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('details.store', $tutorial->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <input type="hidden" name="tutorial_id" value="{{ $tutorial->id }}">
        <div>
            <label class="block font-semibold">Teks</label>
            <textarea name="text" rows="3" class="w-full p-2 border rounded"></textarea>
        </div>

        <div>
            <label class="block font-semibold">Gambar</label>
            <input type="file" name="image" class="w-full">
        </div>

        <div>
            <label class="block font-semibold">Kode</label>
            <textarea name="code" rows="3" class="w-full p-2 border rounded" placeholder="Masukkan kode..."></textarea>
        </div>

        <div>
            <label class="block font-semibold">URL Tambahan</label>
            <input type="url" name="url" class="w-full p-2 border rounded">
        </div>

        <div>
            <label class="block font-semibold">Urutan</label>
            <input type="number" name="order" class="w-full p-2 border rounded" required>
        </div>

        <div>
            <label class="block font-semibold">Status</label>
            <select name="status" class="w-full p-2 bg-primary border rounded">
                <option value="show">Show</option>
                <option value="hide">Hide</option>
            </select>
        </div>

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Simpan</button>
        <a href="{{ route('details.index', $tutorial->id) }}" class="text-gray-600 underline ml-2">Batal</a>
    </form>
@endsection
