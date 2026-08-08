<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\RestaurantPOS\Ingredient;
class IngredientController extends Controller { public function index() { return Ingredient::paginate(); } }