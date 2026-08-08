<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\HumanResources\Employee;
class EmployeeController extends Controller { public function index() { return Employee::paginate(); } }