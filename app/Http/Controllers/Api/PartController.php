<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\AutoRepairManagement\Part;
class PartController extends Controller { public function index() { return Part::paginate(); } }