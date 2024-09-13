<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consumption extends Model
{
    use HasFactory;

    protected $table ='consumption';
    protected $fillable = [
        'feed_id',
        'quantity',
        'note'
    ];

    public function feed() {
        return $this->hasOne(Feed::class, 'id', 'feed_id');
    }
}
