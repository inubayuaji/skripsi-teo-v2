<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'featured_image',
        'is_active',
        'images'
    ];

    public function getImagesAttribute($value)
    {
        return explode(',', $value);
    }

    public function setImagesAttribute($value)
    {
        $this->attributes['images'] = implode(',', $value);
    }
}
