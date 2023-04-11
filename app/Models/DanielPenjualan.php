<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanielPenjualan extends Model
{
    use HasFactory;

    
    protected $connection = 'pgsql2';
    protected $table = 'tbl_ikdt2';
    protected $primaryKey = 'notransaksi_id';
    public $incrementing = false;
    protected $keyType = 'char';

    public function itemPenjualan()
    {
        return $this->belongsTo(Items::class, 'merek', 'kodeitem');
    }
}