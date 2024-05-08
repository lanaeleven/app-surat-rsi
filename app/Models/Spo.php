<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Spo extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $table = 'spo';

    public $timestamps = false;

    public function direksi(): BelongsTo {
        return $this->belongsTo(Direksi::class, 'idDireksi');
    }
}
