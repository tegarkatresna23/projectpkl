<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi mass-assignment
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
    ];
}
