@extends('layout')

@section('content')
    <h1>Tambah Transaksi</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('transactions.store') }}" method="POST">
        @csrf
        <div>
            <label for="nama_pembeli">Nama Pembeli:</label>
            <input type="text" name="nama_pembeli" id="nama_pembeli" required>
        </div>
        <div>
            <label for="nomor_telepon">Nomor Telepon:</label>
            <input type="text" name="nomor_telepon" id="nomor_telepon" required>
        </div>
        <div>
            <label for="alamat">Alamat:</label>
            <input type="text" name="alamat" id="alamat" required>
        </div>
        <div>
            <label for="catatan">Catatan:</label>
            <textarea name="catatan" id="catatan"></textarea>
        </div>
        <div id="kue-fields">
            <div class="kue-field">
                <label for="kode_kue_1">Kode Kue:</label>
                <select name="kode_kue[]" id="kode_kue_1" data-index="1" class="kode-kue" required>
                    <option value="">Pilih Kue</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->kode_kue }}" data-harga="{{ $product->harga_kue }}">{{ $product->nama_kue }}</option>
                    @endforeach
                </select>
                <label for="jumlah_kue_1">Jumlah Kue:</label>
                <input type="number" name="jumlah_kue[]" id="jumlah_kue_1" data-index="1" class="jumlah-kue" required>
                <label for="total_harga_1">Total Harga:</label>
                <input type="text" name="total_harga[]" id="total_harga_1" class="total-harga" readonly>
            </div>
        </div>
        <button type="button" id="tambah-kue">Tambah Kue</button>
        <button type="submit">Simpan</button>
    </form>

    <script>
        document.getElementById('tambah-kue').addEventListener('click', function() {
            var kueFields = document.getElementById('kue-fields');
            var nextIndex = kueFields.querySelectorAll('.kue-field').length + 1;

            var newKueField = document.createElement('div');
            newKueField.classList.add('kue-field');

            var kodeKueLabel = document.createElement('label');
            kodeKueLabel.setAttribute('for', 'kode_kue_' + nextIndex);
            kodeKueLabel.textContent = 'Kode Kue:';
            newKueField.appendChild(kodeKueLabel);

            var selectKue = document.createElement('select');
            selectKue.setAttribute('name', 'kode_kue[]');
            selectKue.setAttribute('id', 'kode_kue_' + nextIndex);
            selectKue.setAttribute('data-index', nextIndex);
            selectKue.classList.add('kode-kue');
            selectKue.setAttribute('required', 'required');
            selectKue.addEventListener('change', updateTotalHarga);
            @foreach ($products as $product)
                var optionKue{{ $loop->index }} = document.createElement('option');
                optionKue{{ $loop->index }}.setAttribute('value', '{{ $product->kode_kue }}');
                optionKue{{ $loop->index }}.setAttribute('data-harga', '{{ $product->harga_kue }}');
                optionKue{{ $loop->index }}.textContent = '{{ $product->nama_kue }}';
                selectKue.appendChild(optionKue{{ $loop->index }});
            @endforeach
            newKueField.appendChild(selectKue);

            var jumlahKueLabel = document.createElement('label');
            jumlahKueLabel.setAttribute('for', 'jumlah_kue_' + nextIndex);
            jumlahKueLabel.textContent = 'Jumlah Kue:';
            newKueField.appendChild(jumlahKueLabel);

            var inputJumlahKue = document.createElement('input');
            inputJumlahKue.setAttribute('type', 'number');
            inputJumlahKue.setAttribute('name', 'jumlah_kue[]');
            inputJumlahKue.setAttribute('id', 'jumlah_kue_' + nextIndex);
            inputJumlahKue.setAttribute('data-index', nextIndex);
            inputJumlahKue.classList.add('jumlah-kue');
            inputJumlahKue.setAttribute('required', 'required');
            inputJumlahKue.addEventListener('input', updateTotalHarga);
            newKueField.appendChild(inputJumlahKue);

            var totalHargaLabel = document.createElement('label');
            totalHargaLabel.setAttribute('for', 'total_harga_' + nextIndex);
            totalHargaLabel.textContent = 'Total Harga:';
            newKueField.appendChild(totalHargaLabel);

            var inputTotalHarga = document.createElement('input');
            inputTotalHarga.setAttribute('type', 'text');
            inputTotalHarga.setAttribute('name', 'total_harga[]');
            inputTotalHarga.setAttribute('id', 'total_harga_' + nextIndex);
            inputTotalHarga.classList.add('total-harga');
            inputTotalHarga.setAttribute('readonly', 'readonly');
            newKueField.appendChild(inputTotalHarga);

            kueFields.appendChild(newKueField);
        });

        function updateTotalHarga(event) {
            var index = event.target.getAttribute('data-index');
            var selectKue = document.getElementById('kode_kue_' + index);
            var jumlahKue = document.getElementById('jumlah_kue_' + index);
            var totalHarga = document.getElementById('total_harga_' + index);

            var hargaKue = selectKue.options[selectKue.selectedIndex].getAttribute('data-harga');
            var jumlah = jumlahKue.value;

            if (hargaKue && jumlah) {
                totalHarga.value = hargaKue * jumlah;
            } else {
                totalHarga.value = 0;
            }
        }

        document.addEventListener('input', function(event) {
            if (event.target.classList.contains('jumlah-kue')) {
                updateTotalHarga(event);
            }
        });

        document.addEventListener('change', function(event) {
            if (event.target.classList.contains('kode-kue')) {
                updateTotalHarga(event);
            }
        });
    </script>
@endsection
