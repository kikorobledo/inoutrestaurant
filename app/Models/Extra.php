<?php

namespace App\Models;

use App\Models\Product;
use App\Models\SaleDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Extra extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'created_by',
        'establishment_id',
        'updated_by'
    ];


    public function products(){
        return $this->morphByMany(Product::class, 'extraable');
    }

    public function saleDetails(){
        return $this->morphByMany(SaleDetail::class, 'extraable');
    }
}
