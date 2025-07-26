<?php

namespace App\Observers;

use App\Models\Booking;
use App\Models\BookingStatusHistory;
use Illuminate\Support\Facades\Auth;

class BookingObserver
{
    public function updated(Booking $booking)
    {
        if ($booking->isDirty('status')) {
            BookingStatusHistory::create([
                'booking_id' => $booking->id,
                'status' => $booking->status,
                'notes' => $booking->status_notes ?? 'Estado actualizado',
                'changed_by' => Auth::id(),
            ]);
        }
    }
}