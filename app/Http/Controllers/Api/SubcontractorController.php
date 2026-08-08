<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\ConstructionERP\Subcontractor;
class SubcontractorController extends Controller { public function index() { return Subcontractor::paginate(); } }