<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\HumanResources\Department;
class DepartmentController extends Controller { public function index() { return Department::paginate(); } }