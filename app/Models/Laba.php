<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laba extends Model
{
    use HasFactory;

    protected $connection = 'pgsql';

    protected $table = 'tbl_laba_new';

    protected $cast = [
        'laba' => 'decimal:0',
        'hargadasar' => 'decimal:0',
        'jumlahdasar' => 'decimal:0',
    ];

    public function getLabaAttribute()
    {
        return 'Rp ' . number_format($this->attributes['laba'], 0, ',', '.');
    }
    
    public function getHargadasarAttribute()
    {
        return 'Rp ' . number_format($this->attributes['hargadasar'], 0, ',', '.');
    }
    protected $primaryKey = 'iddetail_id';
    public $incrementing = false;
    protected $keyType = 'char';
    

}