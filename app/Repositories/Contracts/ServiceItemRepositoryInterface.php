<?php
namespace App\Repositories\Contracts;
use App\Models\ServiceItem; use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ServiceItemRepositoryInterface{
    public function paginate(int $perPage=10): LengthAwarePaginator;
    public function all();
    public function find(int $id): ?ServiceItem;
    public function create(array $data): ServiceItem;
    public function update(ServiceItem $item, array $data): ServiceItem;
    public function delete(ServiceItem $item): void;
}
