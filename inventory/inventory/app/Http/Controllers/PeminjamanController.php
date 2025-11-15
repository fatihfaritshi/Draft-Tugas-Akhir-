<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    public function index()
    {
        // Ambil data peminjaman gabung dengan tabel pivot & barang
        $borrows = DB::table('borrows')
            ->join('borrow_item', 'borrows.id', '=', 'borrow_item.borrow_id')
            ->join('barangs', 'borrow_item.barcode', '=', 'barangs.kode_barcode')
            ->select('borrows.*', 'borrow_item.barcode', 'barangs.nama_barang', 'barangs.gambar')
            ->get();
        return view('tb_peminjaman', [
            "active" => 'peminjaman',
            "borrows" => $borrows
        ]);
    }
}
