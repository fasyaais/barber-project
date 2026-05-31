<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'name',
        'cv',
        'no_whatsapp',
        'email',
        'submited_at',
    ];

    public function job()
    {
        return $this->belongsTo(Job::class,'job_id');
        
    }
}
