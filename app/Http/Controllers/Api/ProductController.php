<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\WarehouseManagement\Product;
class ProductController extends Controller { public function index() { return Product::paginate(); } }