<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\RestaurantPOS\DiningTable;
class DiningTableController extends Controller { public function index() { return DiningTable::paginate(); } }