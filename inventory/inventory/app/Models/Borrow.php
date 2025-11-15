<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Borrow extends Model
{
    use HasFactory;

    protected $fillable = [
        'borrow_id',
        'status',
        'borrow_date',
        'borrower_name',
        'return_date',
    ];

    // Definisikan relasi satu peminjaman bisa memiliki banyak barang
    public function items()
    {
        return $this->belongsToMany(Item::class, 'borrow_item', 'borrow_id', 'barcode');
    }

    public function barangItems()
    {
        return DB::table('borrow_item')
            ->join('barangs', 'borrow_item.barcode', '=', 'barangs.kode_barcode')
            ->where('borrow_item.borrow_id', $this->id)
            ->select('barangs.*')
            ->get();
    }
}
