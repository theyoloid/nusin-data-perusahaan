<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laba extends Model
{
    use HasFactory;

    protected $connection = 'pgsql';

    protected $table = 'tbl_laba_new';
    protected $primaryKey = 'iddetail_id';
    public $incrementing = false;
    protected $keyType = 'char';
    

}