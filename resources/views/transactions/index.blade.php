@extends('layout')

@section('content')
    <h1>Daftar Transaksi</h1>
    <a href="{{ route('transactions.create') }}">Tambah Transaksi</a>
    <form action="{{ route('transactions.index') }}" method="GET">
        @csrf
        <label for="tanggal">Pilih Tanggal:</label>
        <select name="tanggal" id="tanggal">
            @foreach ($distinctDates as $date)
                <option value="{{ $date }}" {{ $selectedMonth == $date ? 'selected' : '' }}>{{ $date }}</option>
            @endforeach
        </select>
        <button type="submit">Filter</button>
    </form>
    <table>
        <thead>
            <tr>
                <th>Kode Transaksi</th>
                <th>Nama Pembeli</th>
                <th>Nomor Telepon</th>
                <th>Alamat</th>
                <th>Catatan</th>
                <th>Jenis Kue</th>
                <th>Jumlah Kue</th>
                <th>Total Harga</th>
                <th>Tanggal</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->kode_transaksi }}</td>
                    <td>{{ $transaction->nama_pembeli }}</td>
                    <td>{{ $transaction->nomor_telepon }}</td>
                    <td>{{ $transaction->alamat }}</td>
                    <td>{{ $transaction->catatan }}</td>
                    <td>{{ $transaction->product->nama_kue }}</td>
                    <td>{{ $transaction->jumlah_kue }}</td>
                    <td>{{ $transaction->total_harga }}</td>
                    <td>{{ $transaction->created_at->format('d-m-Y') }}</td>
                    <td>
                        <form action="{{ route('transactions.destroy', $transaction->kode_transaksi) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>

                        
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <button>
        <a href="{{ route('myadmin.index') }}">Back</a>
    </button>
@endsection
