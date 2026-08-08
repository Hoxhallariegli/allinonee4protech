<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\SchoolManagement\Timetable;
class TimetableController extends Controller { public function index() { return Timetable::paginate(); } }