<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\ClinicManagement\Visit;
class VisitController extends Controller { public function index() { return Visit::paginate(); } }