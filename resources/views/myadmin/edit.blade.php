@extends('layout')

@section('content')
    <h1>Edit Kue</h1>

    <form action="{{ route('myadmin.update', $product->kode_kue) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
            <label for="nama_kue">Nama Kue:</label>
            <input type="text" name="nama_kue" id="nama_kue" value="{{ $product->nama_kue }}" required>
        </div>
        <div>
            <label for="deskripsi">Deskripsi:</label>
            <textarea name="deskripsi" id="deskripsi" required>{{ $product->deskripsi }}</textarea>
        </div>
        <div>
            <label for="harga_kue">Harga Kue:</label>
            <input type="number" name="harga_kue" id="harga_kue" value="{{ $product->harga_kue }}" required>
        </div>
        <div>
            <label for="gambar_kue">Gambar Kue:</label>
            <input type="file" name="gambar_kue" id="gambar_kue">
        </div>
        <button type="submit">Update</button>
    </form>
@endsection
