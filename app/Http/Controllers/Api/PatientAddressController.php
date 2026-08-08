<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\ClinicManagement\PatientAddress;
class PatientAddressController extends Controller { public function index() { return PatientAddress::paginate(); } }