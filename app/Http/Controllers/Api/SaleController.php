<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\WarehouseManagement\Sale;
class SaleController extends Controller { public function index() { return Sale::paginate(); } }