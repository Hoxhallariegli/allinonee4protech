<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\AgricultureManagement\Crop;
class CropController extends Controller { public function index() { return Crop::paginate(); } }