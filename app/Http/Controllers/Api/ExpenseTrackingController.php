<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\AutoRepairManagement\ExpenseTracking;
class ExpenseTrackingController extends Controller { public function index() { return ExpenseTracking::paginate(); } }