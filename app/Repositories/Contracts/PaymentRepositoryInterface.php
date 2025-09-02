<?php
namespace App\Repositories\Contracts;
use App\Models\{Payment,Budget};
interface PaymentRepositoryInterface{ public function create(Budget $budget, array $data): Payment; }
