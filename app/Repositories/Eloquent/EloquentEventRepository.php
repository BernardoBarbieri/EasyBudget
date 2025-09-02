<?php
namespace App\Repositories\Eloquent;

use App\Models\Event; use App\Repositories\Contracts\EventRepositoryInterface;

class EloquentEventRepository implements EventRepositoryInterface
{
    public function paginateWithSearch(?string $q, int $perPage=10){
        return Event::when($q, fn($qb)=>$qb->where('title','like',"%{$q}%"))->latest()->paginate($perPage);
    }
    public function find(int $id): ?Event{ return Event::with('budget.items.service')->find($id); }
    public function create(array $data): Event{ return Event::create($data); }
    public function update(Event $event, array $data): Event{ $event->update($data); return $event; }
    public function delete(Event $event): void{ $event->delete(); }
}
