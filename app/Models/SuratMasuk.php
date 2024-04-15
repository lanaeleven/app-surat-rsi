<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuratMasuk extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $table = 'surat_masuk';

    public $timestamps = false;

    public function direksi(): BelongsTo {
        return $this->belongsTo(Direksi::class, 'idDireksi');
    }
}
