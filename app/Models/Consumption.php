<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consumption extends Model
{
    use HasFactory;

    protected $table ='consumption';
    protected $fillable = [
        'product_id',
        'quantity',
        'note'
    ];

    public function product() {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
