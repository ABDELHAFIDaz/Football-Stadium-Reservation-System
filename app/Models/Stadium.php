<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stadium extends Model
{
    protected $fillable = [
        'managerId',
        'name',
        'city_id',
        'address',
        'capacity',
        'description',
        'equipments',
        'status',
        'price_per_hour',
        'stadium_image_url',
        'open_from',
        'open_until',
        'note',
    ];

    protected $casts = [
        'open_from' => 'datetime:H:i',
        'open_until' => 'datetime:H:i',
        'price_per_hour' => 'float',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'managerId', 'id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'customerId', 'id');
    }
}
