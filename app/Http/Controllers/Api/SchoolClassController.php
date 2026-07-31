<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\SchoolManagement\SchoolClass;
class SchoolClassController extends Controller { public function index() { return SchoolClass::paginate(); } }