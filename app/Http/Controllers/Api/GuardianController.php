<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\SchoolManagement\Guardian;
class GuardianController extends Controller { public function index() { return Guardian::paginate(); } }