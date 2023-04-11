<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanielPiutang extends Model
{
    use HasFactory;   
    protected $connection = 'pgsql2';
    protected $table = 'tbl_piutang';
    protected $primaryKey = 'iddetail_id';
    public $incrementing = false;
    protected $keyType = 'char';
}