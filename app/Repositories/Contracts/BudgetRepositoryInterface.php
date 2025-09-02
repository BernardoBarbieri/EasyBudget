<?php
namespace App\Repositories\Contracts;
use App\Models\{Budget, Event};
interface BudgetRepositoryInterface{ public function findByEvent(Event $event): ?Budget; public function createForEvent(Event $event, array $data=[]): Budget; public function update(Budget $budget, array $data): Budget; }
