<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\ClinicManagement\Doctor;
class DoctorController extends Controller { public function index() { return Doctor::paginate(); } }