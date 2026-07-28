<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\EstimateItem;
class EstimateItemController extends Controller { public function index() { return EstimateItem::paginate(); } }