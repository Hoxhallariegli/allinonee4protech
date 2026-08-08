<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\FleetManagement\Trip;
class TripController extends Controller { public function index() { return Trip::paginate(); } }