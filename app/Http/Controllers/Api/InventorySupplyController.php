<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\AgricultureManagement\InventorySupply;
class InventorySupplyController extends Controller { public function index() { return InventorySupply::paginate(); } }