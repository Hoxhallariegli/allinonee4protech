<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Finance\Transaction;
class TransactionController extends Controller { public function index() { return Transaction::paginate(); } }