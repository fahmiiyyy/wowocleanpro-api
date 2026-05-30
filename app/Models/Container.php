<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Container extends Model
{
    use HasFactory;

    protected $fillable = [
        'container_id',
        'waste_type',
        'weight_kg',
        'status'
    ];

    public function logs()
    {
        return $this->hasMany(TrackingLog::class);
    }
}