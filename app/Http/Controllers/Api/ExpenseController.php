<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Finance\Expense;
class ExpenseController extends Controller { public function index() { return Expense::paginate(); } }