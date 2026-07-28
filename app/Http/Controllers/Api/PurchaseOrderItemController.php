<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\PurchaseOrderItem;
class PurchaseOrderItemController extends Controller { public function index() { return PurchaseOrderItem::paginate(); } }