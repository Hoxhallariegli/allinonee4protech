<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\SchoolManagement\Subject;
class SubjectController extends Controller { public function index() { return Subject::paginate(); } }