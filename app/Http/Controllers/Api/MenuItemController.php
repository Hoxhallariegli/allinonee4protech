<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\RestaurantPOS\MenuItem;
class MenuItemController extends Controller { public function index() { return MenuItem::paginate(); } }