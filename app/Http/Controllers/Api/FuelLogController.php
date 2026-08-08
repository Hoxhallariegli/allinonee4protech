<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\FleetManagement\FuelLog;
class FuelLogController extends Controller { public function index() { return FuelLog::paginate(); } }