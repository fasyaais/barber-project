<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'position_id',
        'merchant_id',
        'description',
        'type',
        'salary',
        'loc',
        'slot',
        'status',
        'due_date',
    ];

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class, 'merchant_id');
    }

    public function pelamar()
    {
        return $this->hasMany(Pelamar::class);
    }
}
