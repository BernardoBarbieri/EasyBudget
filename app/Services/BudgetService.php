<?php
namespace App\Services;

use App\Models\Budget; use App\Models\EventItem; use Illuminate\Support\Facades\DB;

class BudgetService
{
    public function recalculate(Budget $budget): Budget
    {
        $subtotal = $budget->items()->sum('total');
        $tax = ($subtotal * ($budget->tax_rate/100));
        $total = max(0, $subtotal + $tax - $budget->discount);
        $budget->update(['subtotal'=>$subtotal,'total'=>$total]);
        return $budget->refresh();
    }

    public function addItem(Budget $budget, $service, int $quantity=1)
    {
        return DB::transaction(function() use($budget,$service,$quantity){
            $item = $budget->items()->create([ 'service_item_id'=>$service->id, 'quantity'=>$quantity, 'unit_price'=>$service->unit_price, 'total'=>$service->unit_price*$quantity ]);
            $this->recalculate($budget);
            return $item;
        });
    }
}
