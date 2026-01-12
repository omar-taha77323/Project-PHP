<?php

namespace App\Models;
use \App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
    'user_id', 'subtotal', 'discount', 'total', 'status',
];

public function user()
{
    return $this->belongsTo(User::class);
}

}
