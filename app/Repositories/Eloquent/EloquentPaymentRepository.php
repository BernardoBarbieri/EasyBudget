<?php
namespace App\Repositories\Eloquent;
use App\Models\{Payment,Budget}; use App\Repositories\Contracts\PaymentRepositoryInterface;

class EloquentPaymentRepository implements PaymentRepositoryInterface{ public function create(Budget $budget, array $data): Payment{ return $budget->payments()->create($data); } }
