<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Establishment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'address',
        'telephone',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function users(){
        return $this->hasMany(Users::class);
    }

    public function categories(){
        return $this->hasMany(Users::class);
    }
}
