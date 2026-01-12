<?php

namespace App\Models;

use \App\Models\Categorie;
use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'sku',
        'price',
        'stock',
        'is_active',
    ];
    public function category()
    {
        return $this->belongsTo(Categorie::class, 'category_id');
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function mainImage()
    {
        return $this->hasOne(ProductImage::class)->where('is_main', true);
    }
}
