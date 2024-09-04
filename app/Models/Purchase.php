<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $table ='purchase';
    protected $fillable = [
        'product_id',
        'vendor',
        'quantity',
        'amount_total'
    ];

    public function product() {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
