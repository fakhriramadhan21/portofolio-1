<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;
    protected $table = "portfolios";
    protected $fillable = [
        'nama',
        'jenis',
        'web',
        'github',
        'deskripsi',
        'foto',
    ];
}
