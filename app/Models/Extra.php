<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\SaleDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Extra extends Model
{
    use HasFactory;

    protected $fillable = [
        'extra_number',
        'name',
        'price',
        'created_by',
        'establishment_id',
        'updated_by'
    ];


    public function products(){
        return $this->morphedByMany(Product::class, 'extraable');
    }

    public function saleDetails(){
        return $this->morphedByMany(SaleDetail::class, 'extraable');
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
