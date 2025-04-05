<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Unit extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $table = 'unit';

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function spos(): BelongsToMany
    {
        return $this->belongsToMany(SPO::class);
    }
}
