<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\ClinicManagement\Prescription;
class PrescriptionController extends Controller { public function index() { return Prescription::paginate(); } }