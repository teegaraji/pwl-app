@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Edit Tutorial</h2>

    <form action="{{ route('tutorials.update', $tutorial->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-semibold">Judul Tutorial</label>
            <input type="text" name="title" class="w-full p-2 border rounded" value="{{ $tutorial->title }}" required>
        </div>

        <div>
            <label class="block font-semibold">Kode Mata Kuliah</label>
            <select name="course_code" class="w-full p-2 border bg-primary rounded" required>
                @foreach ($makulList as $makul)
                    <option value="{{ $makul['kdmk'] }}" {{ $makul['kdmk'] == $tutorial->course_code ? 'selected' : '' }}>
                        {{ $makul['kdmk'] }} - {{ $makul['nama'] }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-semibold">Email Creator</label>
            <input type="email" name="creator_email" class="w-full p-2 border rounded"
                value="{{ $tutorial->creator_email }}" readonly>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
        <a href="{{ route('tutorials.index') }}" class="text-gray-600 underline ml-2">Batal</a>
    </form>
@endsection
