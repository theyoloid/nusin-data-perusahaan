<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JatimLaba extends Model
{
    use HasFactory;
    
    protected $connection = 'pgsql1';

    protected $table = 'tbl_laba_new';
    protected $primaryKey = 'iddetail_id';
    public $incrementing = false;
    protected $keyType = 'char';
}