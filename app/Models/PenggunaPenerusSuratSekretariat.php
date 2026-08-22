<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PenggunaPenerusSuratSekretariat extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $table = 'pengguna_penerus_surat_sekretariat';

    public function userPengirim(): BelongsTo {
        return $this->belongsTo(User::class, 'userId');
    }
}
