<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = ['tax','total','subtotal_before_discount','subtotal_after_discount'];

    public function items()
    {
        return $this->belongsToMany(Product::class,'invoice_items')->withPivot(['quantity','discount_value','cost','discount']);
    }
}
