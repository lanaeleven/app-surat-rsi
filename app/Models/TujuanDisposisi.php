<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TujuanDisposisi extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $table = 'tujuan_disposisi';

    public $timestamps = false;
}
