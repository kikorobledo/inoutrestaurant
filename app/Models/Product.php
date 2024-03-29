<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Extra;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_number',
        'name',
        'description',
        'image_url',
        'stock',
        'purchase_price',
        'sale_price',
        'category_id',
        'created_by',
        'establishment_id',
        'updated_by'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function establishmentBelonging(){
        return $this->belongsTo(Establishment::class, 'establishment_id');
    }

    public function createdBy(){
        return $this->belongsTo(User::class, 'created_by')->withTrashed();
    }

    public function updatedBy(){
        return $this->belongsTo(User::class, 'updated_by')->withTrashed();
    }

    public function extras(){
        return $this->morphToMany(Extra::class, 'extraable');
    }

    public function getCreatedAtAttribute(){
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['created_at'])->format('d-m-Y H:i:s');
    }

    public function getUpdatedAtAttribute(){
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['updated_at'])->format('d-m-Y H:i:s');
    }
}
