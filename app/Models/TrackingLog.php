<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TrackingLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'container_id',
        'location',
        'timestamp',
        'description'
    ];

    public function container()
    {
        return $this->belongsTo(Container::class);
    }
}