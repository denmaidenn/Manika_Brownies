@extends('layout')

@section('content')
    <h1>Daftar Kue</h1>
    <a href="{{ route('myadmin.create') }}">Tambah Kue</a>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Kue</th>
                <th>Nama Kue</th>
                <th>Harga Kue</th>
                <th>Gambar Kue</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $manika)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $manika->kode_kue }}</td>
                    <td>{{ $manika->nama_kue }}</td>
                    <td>{{ $manika->formatted_harga}}</td>
                    <td><img src="{{ asset('storage/' . $manika->gambar_kue) }}" alt="{{ $manika->namakue }}" width="100"></td>
                    <td>{{ $manika->created_at->format('d-m-Y') }}</td>
                    <td>
                        <a href="{{ route('myadmin.edit', $manika->kode_kue) }}">Edit</a>
                        <form action="{{ route('myadmin.destroy', $manika->kode_kue) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
