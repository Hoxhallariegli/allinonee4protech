<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\RestaurantPOS\Recipe;
class RecipeController extends Controller { public function index() { return Recipe::paginate(); } }