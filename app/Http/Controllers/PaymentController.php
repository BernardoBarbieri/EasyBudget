<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request; use App\Models\Budget; use App\Repositories\Contracts\PaymentRepositoryInterface as Payments;

class PaymentController extends Controller
{
    public function __construct(private Payments $payments){ $this->middleware('auth'); }
    public function store(Request $r,$budgetId){ $budget=Budget::findOrFail($budgetId); $data=$r->validate(['amount'=>'required|numeric|min:0','method'=>'required|in:card,pix,cash']); $data['transaction_ref']='SIM-'.now()->timestamp; $this->payments->create($budget,$data); $budget->update(['status'=>'paid']); return back(); }
}
