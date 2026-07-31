<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\WarehouseManagement\StockTransfer;
class StockTransferController extends Controller { public function index() { return StockTransfer::paginate(); } }