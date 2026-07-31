<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\SchoolManagement\Teacher;
class TeacherController extends Controller { public function index() { return Teacher::paginate(); } }