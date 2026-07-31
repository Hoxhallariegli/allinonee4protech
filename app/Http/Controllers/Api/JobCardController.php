<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\AutoRepairManagement\JobCard;
class JobCardController extends Controller { public function index() { return JobCard::paginate(); } }