@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Tambah Tutorial Baru</h2>

    <form action="{{ route('tutorials.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block font-semibold">Judul Tutorial</label>
            <input type="text" name="title" required class="w-full p-2 border rounded">
        </div>

        <div>
            <label class="block font-semibold">Kode Mata Kuliah</label>
            <select name="course_code" id="course_code" class="w-full p-2 border bg-primary rounded" required>
                @foreach ($makulList as $makul)
                    <option value="{{ $makul['kdmk'] }}" data-nama="{{ $makul['nama'] }}">
                        {{ $makul['kdmk'] }} - {{ $makul['nama'] }}
                    </option>
                @endforeach
            </select>
        </div>

        <input type="hidden" name="kode_matkul" id="kode_matkul">
        <input type="hidden" name="nama_matkul" id="nama_matkul">

        <div>
            <label class="block font-semibold">Email Creator</label>
            <input type="email" name="creator_email" class="w-full p-2 border rounded" value="{{ session('user_email') }}"
                readonly>
        </div>

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Simpan</button>
        <a href="{{ route('tutorials.index') }}" class="text-gray-600 underline ml-2">Batal</a>
    </form>
    <script>
        // Update input hidden saat course_code berubah
        document.getElementById('course_code').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            document.getElementById('kode_matkul').value = selectedOption.value;
            document.getElementById('nama_matkul').value = selectedOption.getAttribute('data-nama');
        });

        // Trigger perubahan awal untuk mengisi nilai default
        document.getElementById('course_code').dispatchEvent(new Event('change'));
    </script>
@endsection
