<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function Offers()
    {
        return $this->belongsToMany(Offer::class,'product_offer')
            ->withPivot('discount_applicable')->withTimestamps();
    }

    public function prices()
    {
        return $this->belongsToMany(Currency::class,'product_prices')->withPivot('price')->withTimestamps();
    }
}
