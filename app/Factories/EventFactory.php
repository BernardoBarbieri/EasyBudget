<?php

namespace App\Factories;

use App\Models\Event;

class EventFactory
{
    public static function create(string $type, array $data)
    {
        switch (strtolower($type)) {
            case 'casamento':
                $data['category'] = 'Casamento';
                $data['location'] = $data['location'] ?? 'Salão de Festas';
                break;
            case 'formatura':
                $data['category'] = 'Formatura';
                $data['location'] = $data['location'] ?? 'Auditório Principal';
                break;
            case 'palestra':
                $data['category'] = 'Palestra';
                $data['location'] = $data['location'] ?? 'Centro de Convenções';
                break;
            default:
                $data['category'] = 'Evento Geral';
        }

        return Event::create($data);
    }
}
