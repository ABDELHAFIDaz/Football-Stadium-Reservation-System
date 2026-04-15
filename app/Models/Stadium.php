<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stadium extends Model
{
    protected $fillable = [
        'managerId',
        'name',
        'city',
        'address',
        'capacity',
        'description',
        'equipments',
        'status',
        'price_per_hour',
        'stadium_image_url',
    ];
}
