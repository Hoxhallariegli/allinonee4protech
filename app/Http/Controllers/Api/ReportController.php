<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\AutoRepairManagement\Report;
class ReportController extends Controller { public function index() { return Report::paginate(); } }