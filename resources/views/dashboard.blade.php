@extends('layout')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard</title>
   
</head>
<body>
   <h1>Daftar Kue</h1>
   <b>Hello {{Auth::user()->username }}! </b>
   <table border="2">
       <thead>
           <tr>
               <th>Nama Kue</th>
               <th>Harga Kue</th>
               <th>Gambar Kue</th>
               <th>Deskripsi</th>
           </tr>
       </thead>
       <tbody>
           @foreach ($products as $manika)
               <tr>
                   <td>{{ $manika->nama_kue }}</td>
                   <td>{{ $manika->formatted_harga }}</td>
                   <td>
                       @if ($manika->gambar_kue)
                           <img src="{{ asset('storage/' . $manika->gambar_kue) }}" alt="{{ $manika->nama_kue }}" width="100">
                       @else
                           <p>Gambar tidak tersedia</p>
                       @endif
                   </td>
                   <td>{{ $manika->deskripsi }}</td>
               </tr>
           @endforeach
       </tbody>
   </table>
   <div>
       

       <div>
            <div>
                <form>
                    <button class="btn btn-primary">Tambah Kue</button>
                </form>
                
                <form>
                    <button>Edit Kue</button>
                </form>

                <form></form>
            </div>
       </div>
       
   </div>

   <form method="POST" action="{{ route('logout') }} ">
           @csrf   
           <div class="mb-3">
               <button class="btn btn-danger" >
                   Logout
               </button>
           </div>
    </form>
   
</body>
</html>
@endsection
