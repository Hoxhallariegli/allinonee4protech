<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\FacilityManagement\MaintenanceRequest;
class MaintenanceRequestController extends Controller { public function index() { return MaintenanceRequest::paginate(); } }