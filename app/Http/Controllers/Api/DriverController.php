<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\FleetManagement\Driver;
class DriverController extends Controller { public function index() { return Driver::paginate(); } }