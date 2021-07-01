<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'telephone',
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
}
