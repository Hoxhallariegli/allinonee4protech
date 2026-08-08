<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\HumanResources\Payroll;
class PayrollController extends Controller { public function index() { return Payroll::paginate(); } }