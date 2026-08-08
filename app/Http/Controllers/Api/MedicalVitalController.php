<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\ClinicManagement\MedicalVital;
class MedicalVitalController extends Controller { public function index() { return MedicalVital::paginate(); } }