<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\RestaurantPOS\Waiter;
class WaiterController extends Controller { public function index() { return Waiter::paginate(); } }