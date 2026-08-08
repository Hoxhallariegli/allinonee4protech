<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Finance\Budget;
class BudgetController extends Controller { public function index() { return Budget::paginate(); } }