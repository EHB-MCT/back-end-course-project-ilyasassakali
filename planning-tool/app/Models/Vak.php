<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vak extends Model
{
    use HasFactory;
    protected $table = 'vakken';
    protected $primaryKey='id';
    protected $fillable=['naam','opleiding','semester','duur','sessies'];




}

