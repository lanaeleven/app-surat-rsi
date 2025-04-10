<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Regulasi extends Model
{
    use HasFactory;
    
    protected $guarded = [
        'id'
    ];

    protected $table = 'regulasi';

    public function jenisRegulasi(): BelongsTo {
        return $this->belongsTo(JenisRegulasi::class, 'idJenisRegulasi');
    }

    public function direksi(): BelongsTo {
        return $this->belongsTo(Direksi::class, 'idDireksi');
    }
}
