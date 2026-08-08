<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\WarehouseManagement\PurchaseOrder;
class PurchaseOrderController extends Controller { public function index() { return PurchaseOrder::paginate(); } }