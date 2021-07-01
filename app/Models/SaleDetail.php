<?php

namespace App\Models;

use App\Models\Extra;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SaleDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_id',
        'product_id',
        'product_name',
        'product_price',
        'quantity',
        'status'
    ];

    public function sale(){
        return $this->belongsTo(Sale::class);
    }

    public function extras(){
        return $this->morphToMany(Extra::class, 'extraable');
    }
}
