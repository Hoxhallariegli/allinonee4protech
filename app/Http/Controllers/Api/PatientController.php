<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\ClinicManagement\Patient;
class PatientController extends Controller { public function index() { return Patient::paginate(); } }