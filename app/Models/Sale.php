<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Table;
use App\Models\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_number',
        'table_id',
        'table_name',
        'client_id',
        'client_name',
        'total_price',
        'total_recived',
        'change',
        'payment_type',
        'status',
        'created_by',
        'establishment_id',
        'updated_by'
    ];

    public function establishmentBelonging(){
        return $this->belongsTo(Establishment::class, 'establishment_id');
    }

    public function createdBy(){
        return $this->belongsTo(User::class, 'created_by')->withTrashed();
    }

    public function updatedBy(){
        return $this->belongsTo(User::class, 'updated_by')->withTrashed();
    }

    public function table(){
        return $this->belongsTo(Table::class)->withTrashed();
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function saleDetails(){
        return $this->hasMany(SaleDetail::class)->with('extras');
    }

    public function getCreatedAtAttribute(){
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['created_at'])->format('d-m-Y H:i:s');
    }

    public function getUpdatedAtAttribute(){
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['updated_at'])->format('d-m-Y H:i:s');
    }
}
