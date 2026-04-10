<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
protected $fillable = [
        'user_id',
        'product_name',
        'category',
        'author',
        'description',
        'price',
        'stock',
        'product_picture'
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

  public function orders()
    {
        return $this->hasMany(Order::class);
    }

public function categories(){
return $this->hasMany(Category::class);
}
}
