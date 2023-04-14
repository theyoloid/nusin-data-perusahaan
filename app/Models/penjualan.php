<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Penjualan extends Model
{
    use HasFactory;

    protected $connection = 'pgsql';
    protected $table = 'tbl_ikdt2';
    protected $cast = [
        'total' => 'decimal:0',
        'harga' => 'decimal:0',
    ];

    public function getTotalAttribute()
    {
        return 'Rp ' . number_format($this->attributes['total'], 0, ',', '.');
    }
    
    public function getHargaAttribute()
    {
        return 'Rp ' . number_format($this->attributes['harga'], 0, ',', '.');
    }
    protected $primaryKey = 'notransaksi_id';
    public $incrementing = false;
    protected $keyType = 'char';

    public function itemPenjualan()
    {
        return $this->belongsTo(Items::class, 'merek', 'kodeitem');
    }
    
}