<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TujuanDisposisi extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $table = 'tujuan_disposisi';

    public $timestamps = false;

    // public function pengirimDisposisi(): HasMany {
    //     return $this->hasMany(DistribusiSurat::class, 'idPengirimDisposisi');
    // }

    public function tujuanDisposisi(): HasMany {
        return $this->hasMany(DistribusiSurat::class, 'idTujuanDisposisi');
    }
}
