<?php

namespace App\Models;
use \App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
  protected $fillable = [
    'user_id',
    'subtotal',
    'discount',
    'shipping_fee',
    'total',
    'status',

    'payment_method',
    'payment_status',

    'shipping_name',
    'shipping_phone',
    'shipping_address',
    'shipping_city',
    'shipping_notes',
];

public function items()
{
    return $this->hasMany(OrderItem::class);
}


public function user()
{
    return $this->belongsTo(User::class);
}

}
