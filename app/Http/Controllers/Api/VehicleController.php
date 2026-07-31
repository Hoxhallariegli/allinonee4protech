<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\AutoRepairManagement\Vehicle;
class VehicleController extends Controller { public function index() { return Vehicle::paginate(); } }