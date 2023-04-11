<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'tbl_ikdt2';
    protected $primaryKey = 'notransaksi_id';
    public $incrementing = false;
    protected $keyType = 'char';

    public function itemPenjualan()
    {
        return $this->belongsTo(Items::class, 'merek', 'kodeitem');
    }
    
}