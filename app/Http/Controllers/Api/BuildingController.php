<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\ConstructionERP\Building;
class BuildingController extends Controller { public function index() { return Building::paginate(); } }