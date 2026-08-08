<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\TravelAgency\TourPackage;
class TourPackageController extends Controller { public function index() { return TourPackage::paginate(); } }