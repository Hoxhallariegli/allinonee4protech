<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\ECommerce\Product;
class ProductController extends Controller { public function index() { return Product::paginate(); } }