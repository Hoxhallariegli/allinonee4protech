<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\RestaurantPOS\Order;
class OrderController extends Controller { public function index() { return Order::paginate(); } }