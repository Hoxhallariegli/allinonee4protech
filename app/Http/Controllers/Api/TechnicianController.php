<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\FacilityManagement\Technician;
class TechnicianController extends Controller { public function index() { return Technician::paginate(); } }