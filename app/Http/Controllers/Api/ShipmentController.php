<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\FleetManagement\Shipment;
class ShipmentController extends Controller { public function index() { return Shipment::paginate(); } }