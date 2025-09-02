<?php
namespace App\Repositories\Eloquent;
use App\Models\ServiceItem; use App\Repositories\Contracts\ServiceItemRepositoryInterface;

class EloquentServiceItemRepository implements ServiceItemRepositoryInterface{
    public function paginate(int $perPage=10){ return ServiceItem::paginate($perPage); }
    public function all(){ return ServiceItem::all(); }
    public function find(int $id): ?ServiceItem{ return ServiceItem::find($id); }
    public function create(array $data): ServiceItem{ return ServiceItem::create($data); }
    public function update(ServiceItem $item, array $data): ServiceItem{ $item->update($data); return $item; }
    public function delete(ServiceItem $item): void{ $item->delete(); }
}
