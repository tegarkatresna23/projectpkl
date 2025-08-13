<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * Kolom yang bisa diisi mass assignment
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'code',
        'name',
        'description',
        'stock',
        'purchase_price',
        'selling_price',
    ];

    /**
     * Relasi ke kategori
     */
   public function category()
{
    return $this->belongsTo(Categorie::class, 'category_id');
}

}
