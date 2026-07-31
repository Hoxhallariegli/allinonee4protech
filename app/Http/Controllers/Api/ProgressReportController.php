<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\ConstructionERP\ProgressReport;
class ProgressReportController extends Controller { public function index() { return ProgressReport::paginate(); } }