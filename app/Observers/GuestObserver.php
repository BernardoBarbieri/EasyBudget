<?php

namespace App\Observers;

use App\Models\Guest;
use Illuminate\Support\Facades\Log;

class GuestObserver
{
    public function updated(Guest $guest)
    {
        if ($guest->isDirty('confirmed') && $guest->confirmed) {
            Log::info("🎟️ Convidado confirmado: {$guest->name} no evento #{$guest->event_id}");
        }
    }
}
