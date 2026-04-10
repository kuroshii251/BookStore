<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'product_name',
        'quantity',
        'harga',
        'foto_payment',
        'Alamat',
        'nama_penerima',
        'nomor_telepon',
'status',
        'payment_method',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

public function products(){
return $this->hasMany(Product::class);
}

public function carts(){
return $this->hasMany(Cart::class);
}
public function categories(){
return $this->hasMany(Category::class);
}
}

