<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\RealEstateCRM\PropertyVisit;
class PropertyVisitController extends Controller { public function index() { return PropertyVisit::paginate(); } }