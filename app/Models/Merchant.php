<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'locate',
        'img',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function job()
    {
        return $this->hasMany(Job::class);
    }

}
