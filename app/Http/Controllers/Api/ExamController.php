<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\SchoolManagement\Exam;
class ExamController extends Controller { public function index() { return Exam::paginate(); } }