<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSurat extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $table = 'jenis_surat';

    public $timestamps = false;


}
