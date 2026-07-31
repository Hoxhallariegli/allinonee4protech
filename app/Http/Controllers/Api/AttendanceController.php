<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\SchoolManagement\Attendance;
class AttendanceController extends Controller { public function index() { return Attendance::paginate(); } }