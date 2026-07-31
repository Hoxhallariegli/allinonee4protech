<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\AutoRepairManagement\JobCardPart;
class JobCardPartController extends Controller { public function index() { return JobCardPart::paginate(); } }