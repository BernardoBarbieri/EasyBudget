<?php
namespace App\Repositories\Eloquent;
use App\Models\{Budget, Event}; use App\Repositories\Contracts\BudgetRepositoryInterface;

class EloquentBudgetRepository implements BudgetRepositoryInterface{
    public function findByEvent(Event $event): ?Budget{ return $event->budget()->with('items.service')->first(); }
    public function createForEvent(Event $event, array $data=[]): Budget{ return $event->budget()->create($data); }
    public function update(Budget $budget, array $data): Budget{ $budget->update($data); return $budget; }
}
