<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\SchoolManagement\Student;
class StudentController extends Controller { public function index() { return Student::paginate(); } }