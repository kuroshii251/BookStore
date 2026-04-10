<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
protected $fillable = ['user_id','category_name'];


 public function users()
    {
        return $this->hasMany(User::class);
    }

 public function carts()
    {
        return $this->hasMany(Cart::class);
    }

  public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function products(){
return $this->hasMany(Product::class);
}
}

