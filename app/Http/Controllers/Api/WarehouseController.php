<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\WarehouseManagement\Warehouse;
class WarehouseController extends Controller { public function index() { return Warehouse::paginate(); } }