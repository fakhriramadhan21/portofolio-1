<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keahlian extends Model
{
    use HasFactory;
    protected $table = "skills";
    protected $fillable = [
        'nama',
        'deskripsi',
    ];
    protected $primaryKey = 'id';
}
