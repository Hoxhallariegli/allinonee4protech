<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\VehicleBrand;
class VehicleBrandController extends Controller { public function index() { return VehicleBrand::paginate(); } }