@extends('layout')

@section('content')
    <h1>Tambah Kue</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('myadmin.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="nama_kue">Nama Kue:</label>
            <input type="text" name="nama_kue" id="nama_kue" required>
        </div>
        <div>
            <label for="deskripsi">Deskripsi:</label>
            <textarea name="deskripsi" id="deskripsi" required></textarea>
        </div>
        <div>
            <label for="harga_kue">Harga Kue:</label>
            <input type="number" name="harga_kue" id="harga_kue" required>
        </div>
        <div>
            <label for="gambar_kue">Gambar Kue:</label>
            <input type="file" name="gambar_kue" id="gambar_kue">
        </div>
        <button type="submit">Simpan</button>

        <div>
            <button>
                <a href="{{ route('myadmin.index') }}">Back</a>
            </button>
        </div>
        
    </form>


@endsection
