<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\VehicleModel;
class VehicleModelController extends Controller { public function index() { return VehicleModel::paginate(); } }