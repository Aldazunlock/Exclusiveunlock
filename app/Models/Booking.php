<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'receive_date',
        'delivery_date',
        'technician',
        'notes',
        'status',
    ];

    protected $casts = [
        'receive_date' => 'date',
        'delivery_date' => 'date',
    ];

    // Estados posibles del trabajo
    const STATUS_PENDING = 'pending';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_WAITING_PARTS = 'waiting_parts';
    const STATUS_COMPLETED = 'completed';
    const STATUS_DELIVERED = 'delivered';
    const STATUS_CANCELLED = 'cancelled';

    public static function statusOptions()
    {
        return [
            self::STATUS_PENDING => 'Pendiente',
            self::STATUS_IN_PROGRESS => 'En Progreso',
            self::STATUS_WAITING_PARTS => 'Esperando Repuestos',
            self::STATUS_COMPLETED => 'Completado',
            self::STATUS_DELIVERED => 'Entregado',
            self::STATUS_CANCELLED => 'Cancelado',
        ];
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(BookingItem::class);
    }

    public function statusHistories()
    {
        return $this->hasMany(BookingStatusHistory::class)->orderBy('created_at', 'desc');
    }

    // Método para imprimir
    public function printToThermal()
    {
        // Lógica de impresión (se implementará en el controlador)
        return route('bookings.print', $this->id);
    }
}
