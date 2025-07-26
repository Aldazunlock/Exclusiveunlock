<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingStatusHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'status',
        'notes',
        'changed_by',
    ];

    protected $casts = [
        'changed_at' => 'datetime',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'changed_by');
    }
}
