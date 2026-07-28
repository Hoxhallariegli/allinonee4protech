<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Estimate;
class EstimateController extends Controller { public function index() { return Estimate::paginate(); } }