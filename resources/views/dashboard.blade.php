@extends('layout')

@section('content')


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
                <button >
                   <a href="{{ route('myadmin.index')}}">Admin</a>
                </button>
            </div>
       </div>
       
   </div>

   <div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button>Logout</button>
        </form>
   </div>
   
   
</body>
</html>
@endsection
