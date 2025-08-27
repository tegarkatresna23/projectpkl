<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockLog extends Model
{
    use HasFactory;

    /**
     * Tabel yang digunakan
     *
     * @var string
     */
    protected $table = 'stock_logs';

    /**
     * Kolom yang bisa diisi
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'change_type',
        'quantity',
        'description',
    ];

    /**
     * Relasi ke Product
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
