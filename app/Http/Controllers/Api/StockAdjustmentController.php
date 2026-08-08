<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\WarehouseManagement\StockAdjustment;
class StockAdjustmentController extends Controller { public function index() { return StockAdjustment::paginate(); } }