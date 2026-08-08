<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\WarehouseManagement\Supplier;
class SupplierController extends Controller { public function index() { return Supplier::paginate(); } }