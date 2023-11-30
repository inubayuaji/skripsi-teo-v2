<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderLine extends Model
{
    use HasFactory;

    protected $table ='order_line';
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'amount_total'
    ];

    public function product() {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
