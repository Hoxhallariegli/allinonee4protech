<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\ConstructionERP\Apartment;
class ApartmentController extends Controller { public function index() { return Apartment::paginate(); } }