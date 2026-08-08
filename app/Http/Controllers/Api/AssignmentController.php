<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\SchoolManagement\Assignment;
class AssignmentController extends Controller { public function index() { return Assignment::paginate(); } }