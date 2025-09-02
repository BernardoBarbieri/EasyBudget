<?php
namespace App\Repositories\Contracts;
use Illuminate\Contracts\Pagination\LengthAwarePaginator; use App\Models\Event;

interface EventRepositoryInterface
{
    public function paginateWithSearch(?string $q, int $perPage=10): LengthAwarePaginator;
    public function find(int $id): ?Event;
    public function create(array $data): Event;
    public function update(Event $event, array $data): Event;
    public function delete(Event $event): void;
}
