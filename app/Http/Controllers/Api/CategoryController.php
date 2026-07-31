<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\WarehouseManagement\Category;
class CategoryController extends Controller { public function index() { return Category::paginate(); } }