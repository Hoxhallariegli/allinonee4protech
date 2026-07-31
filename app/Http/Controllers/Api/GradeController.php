<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\SchoolManagement\Grade;
class GradeController extends Controller { public function index() { return Grade::paginate(); } }