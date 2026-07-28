<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\VehicleDocument;
class VehicleDocumentController extends Controller { public function index() { return VehicleDocument::paginate(); } }