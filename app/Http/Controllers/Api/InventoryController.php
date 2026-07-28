<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Inventory;
class InventoryController extends Controller { public function index() { return Inventory::paginate(); } }