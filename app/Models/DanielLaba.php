<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanielLaba extends Model
{
    use HasFactory;
    
    protected $connection = 'pgsql2';

    protected $table = 'tbl_laba_new';
    protected $primaryKey = 'iddetail_id';
    public $incrementing = false;
    protected $keyType = 'char';
}