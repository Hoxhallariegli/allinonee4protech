<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\AutoRepairManagement\Appointment;
class AppointmentController extends Controller { public function index() { return Appointment::paginate(); } }