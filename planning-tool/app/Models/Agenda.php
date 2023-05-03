<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $fillable = [
        'vak_id',
        'datum',
        'beginuur',
        'einduur',
        'lokaal',
        'leerkracht',
    ];

    public function vak()
    {
        return $this->belongsTo(Vak::class);
    }
}
