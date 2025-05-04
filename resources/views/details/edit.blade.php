@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Edit Detail Tutorial</h2>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 mb-4 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('details.update', ['tutorial' => $tutorial->id, 'detail' => $detail->id]) }}" method="POST"
        enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <input type="hidden" name="tutorial_id" value="{{ $tutorial->id }}">

        <div>
            <label class="block font-semibold">Teks</label>
            <textarea name="text" rows="3" class="w-full p-2 border rounded">{{ $detail->text }}</textarea>
        </div>

        <div>
            <label class="block font-semibold">Gambar (jika ingin ganti)</label>
            <input type="file" name="image" class="w-full">
            @if ($detail->image)
                <p class="text-sm text-gray-500 mt-1">Gambar saat ini tersimpan.</p>
            @endif
        </div>

        <div>
            <label class="block font-semibold">Kode</label>
            <textarea name="code" rows="3" class="w-full p-2 border rounded">{{ $detail->code }}</textarea>
        </div>

        <div>
            <label class="block font-semibold">URL Tambahan</label>
            <input type="url" name="url" class="w-full p-2 border rounded" value="{{ $detail->url }}">
        </div>

        <div>
            <label class="block font-semibold">Urutan</label>
            <input type="number" name="order" class="w-full p-2 border rounded" value="{{ $detail->order }}" required>
        </div>

        <div>
            <label class="block font-semibold">Status</label>
            <select name="status" class="w-full p-2 border rounded">
                <option value="show" {{ $detail->status == 'show' ? 'selected' : '' }}>Show</option>
                <option value="hide" {{ $detail->status == 'hide' ? 'selected' : '' }}>Hide</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
            Update
        </button>
        <a href="{{ route('details.index', $detail->tutorial_id) }}" class="text-gray-600 underline ml-2">Batal</a>
    </form>
@endsection
