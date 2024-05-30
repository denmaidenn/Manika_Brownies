<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index(Request $request)
{
    $selectedMonth = $request->input('tanggal', date('Y-m'));
    $distinctDates = Transaction::distinct()
        ->orderBy('created_at')
        ->pluck('created_at')
        ->map(function ($date) {
            return $date->format('Y-m');
        })
        ->unique();

    $transactions = Transaction::whereYear('created_at', '=', substr($selectedMonth, 0, 4))
        ->whereMonth('created_at', '=', substr($selectedMonth, 5, 2))
        ->get();

    return view('transactions.index', compact('transactions', 'distinctDates', 'selectedMonth'));
    }

    public function create()
    {
        $products = Product::all();
        return view('transactions.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pembeli' => 'required|string|max:255',
            'nomor_telepon' => 'required|numeric',
            'alamat' => 'required|string|max:255',
            'catatan' => 'nullable|string',
            'kode_kue.*' => 'required|exists:products,kode_kue',
            'jumlah_kue.*' => 'required|integer|min:1',
        ]);

        try {
            DB::beginTransaction();

            foreach ($validated['kode_kue'] as $index => $kode_kue) {
                $lastTransaction = Transaction::orderBy('kode_transaksi', 'desc')->first();
                $nextCode = $lastTransaction ? intval(substr($lastTransaction->kode_transaksi, 4)) + 1 : 1;
                $kodeTransaksi = 'TRK-' . sprintf('%05d', $nextCode);

                $product = Product::where('kode_kue', $kode_kue)->firstOrFail();
                $total_harga = $product->harga_kue * $validated['jumlah_kue'][$index];

                $transaction = new Transaction();
                $transaction->kode_transaksi = $kodeTransaksi;
                $transaction->kode_kue = $kode_kue;
                $transaction->nama_pembeli = $validated['nama_pembeli'];
                $transaction->nomor_telepon = $validated['nomor_telepon'];
                $transaction->alamat = $validated['alamat'];
                $transaction->catatan = $validated['catatan'];
                $transaction->jumlah_kue = $validated['jumlah_kue'][$index];
                $transaction->total_harga = $total_harga;
                $transaction->save();
            }

            DB::commit();

            return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => 'Gagal menyimpan transaksi: ' . $e->getMessage()]);
        }
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}