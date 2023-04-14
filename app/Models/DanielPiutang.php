<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanielPiutang extends Model
{
    use HasFactory;   
    protected $connection = 'pgsql2';
    protected $table = 'tbl_piutang';
        
        protected $cast = [
        'totalbayar' => 'decimal:0',
        'totalpotongan' => 'decimal:0',
        'piutang' => 'decimal:0',
    ];

    public function getTotalbayarAttribute()
    {
        return 'Rp ' . number_format($this->attributes['totalbayar'], 0, ',', '.');
    }
    

    public function getTotalpotonganAttribute()
    {
        return 'Rp ' . number_format($this->attributes['totalpotongan'], 0, ',', '.');
    }
    
    public function getPiutangAttribute()
    {
        return 'Rp ' . number_format($this->attributes['piutang'], 0, ',', '.');
    }
    
    protected $primaryKey = 'iddetail_id';
    public $incrementing = false;
    protected $keyType = 'char';
}