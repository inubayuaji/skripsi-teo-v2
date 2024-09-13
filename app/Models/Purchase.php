<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $table ='purchase';
    protected $fillable = [
        'feed_id',
        'vendor',
        'quantity',
        'amount_total'
    ];

    public function feed() {
        return $this->hasOne(feed::class, 'id', 'feed_id');
    }
}
