<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    use HasFactory;

    // Nama tabel di database (opsional jika Laravel bisa menebak dari nama model)
    protected $table = 'purchaseitems';

    // Kolom yang boleh diisi secara mass-assignment
    protected $fillable = [
        'purchase_id',
        'product_id',
        'quantity',
        'price',
        'subtotal',
    ];

    /**
     * Relasi ke tabel purchases
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id'); // pastikan foreign key sesuai di DB
    }

    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'purchase_id'); // foreign key ke tabel purchases
    }
}

