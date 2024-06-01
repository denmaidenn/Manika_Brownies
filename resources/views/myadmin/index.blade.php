@extends('layout')

@section('content')

    <div class="container">
        <div class="title-div">
            <h1>Daftar Kue</h1>
        </div>

        <div class="fitur-div">
            <button class="styled-button">
                <a href="{{ route('myadmin.create') }}">Tambah Kue</a>
            </button>
            <button class="styled-button">
                <a href="{{ route('sales.index') }}">Sales</a>
            </button>
            <button class="styled-button">
                <a href="{{ route('transactions.index') }}">Transaction</a>
            </button>
            <button class="styled-button">
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </button>
        </div>

        <div>
            <table class="styled-table">
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
                            <div class="aksi-div">
                                <a class="action-link" href="{{ route('myadmin.edit', $manika->kode_kue) }}">Edit</a>
                                <form action="{{ route('myadmin.destroy', $manika->kode_kue) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="styled-button-delete">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="logout">
       <form method="POST" action="{{ route('logout') }}">
           @csrf   
           <div class="mb-3">
               <button class="styled-button-logout">
                   Logout
               </button>
           </div>
       </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkboxes = document.querySelectorAll('.bs-checkbox');
            const maxChecks = 4;

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    const checkedCheckboxes = document.querySelectorAll('.bs-checkbox:checked');
                    if (checkedCheckboxes.length > maxChecks) {
                        this.checked = false;
                        alert('Maksimal hanya 4 kue yang dapat dijadikan Best Seller.');
                    } else {
                        const id = this.getAttribute('data-id');
                        const status = this.checked;

                        fetch(`/myadmin/${id}/set-bs`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ status })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (!data.success) {
                                this.checked = !status;
                                alert(data.message);
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
