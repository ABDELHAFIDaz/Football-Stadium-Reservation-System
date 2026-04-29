<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'customerId',
        'reservation_date',
        'start_time',
        'end_time',
        'status',
        'total_price',
        'note',
        'stadium_id',
    ];

    protected $casts = [
        'reservation_date' => 'date',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
        'total_price' => 'float',
    ];


    public function user(){
        return $this->belongsTo(User::class, 'customerId', 'id');
    }


    public function stadium(){
        return $this->belongsTo(Stadium::class);
    }

}
