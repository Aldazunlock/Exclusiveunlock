<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'brand_id',
        'brand_model_id',
        'device_number',
        'color',
        'provider',
        'device_password',
        'fault_discription',
        'cost',
        'amount',
        'power_on',
        'charging',
        'network',
        'display',
        'camera',
        'battery',
    ];

    protected $casts = [
        'power_on' => 'boolean',
        'charging' => 'boolean',
        'network' => 'boolean',
        'display' => 'boolean',
        'camera' => 'boolean',
        'battery' => 'boolean',
        'cost' => 'decimal:2',
        'amount' => 'decimal:2',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function brandModel()
    {
        return $this->belongsTo(BrandModel::class, 'brand_model_id');
    }
}
