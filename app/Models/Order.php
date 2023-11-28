<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';
    protected $fillable = [
        'no_invoice',
        'costumer_id',
        'amount_total',
        'shipment_total',
        'shipment_address',
        'status'
    ];
}
