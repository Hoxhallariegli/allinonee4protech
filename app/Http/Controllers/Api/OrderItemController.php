<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\RestaurantPOS\OrderItem;
class OrderItemController extends Controller { public function index() { return OrderItem::paginate(); } }