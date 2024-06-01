@extends('layout')

@section('content')


    <h1>Daftar Penjualan</h1>
    <table class="styled-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pembeli</th>
                <th>Nomor Telepon</th>
                <th>Alamat</th>
                <th>Jenis Kue</th>
                <th>Jumlah Kue</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $key => $group)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $key }}</td>
                    <td>{{ $group->first()->nomor_telepon }}</td>
                    <td>{{ $group->first()->alamat }}</td>
                    <td>{{ $group->first()->kode_kue }}</td>
                    <td>{{ $group->sum('jumlah_kue') }}</td>
                    <td>
                        <button class="styled-button" onclick="openModal('{{ $key }}')">Detail Penjualan</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div>
        <button class="styled-button">
            <a href="{{ route('myadmin.index') }}" class="button-link">Back</a>
        </button>
    </div>

    <!-- The Modal -->
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <div id="modal-content"></div>
        </div>
    </div>

    <script>
        function openModal(kodeTransaksi) {
            var modal = document.getElementById("myModal");
            var modalContent = document.getElementById("modal-content");
            modal.style.display = "block";
            modalContent.innerHTML = "<h2>Detail Penjualan - " + kodeTransaksi + "</h2><ul>";

            @foreach ($transactions as $key => $group)
                if ("{{ $key }}" === kodeTransaksi) {
                    @foreach ($group as $transaction)
                        modalContent.innerHTML += "<li>{{ $transaction->kode_kue }} - {{ $transaction->jumlah_kue }}</li>";
                    @endforeach
                }
            @endforeach

            modalContent.innerHTML += "</ul>";
        }

        function closeModal() {
            var modal = document.getElementById("myModal");
            modal.style.display = "none";
        }
    </script>
@endsection
