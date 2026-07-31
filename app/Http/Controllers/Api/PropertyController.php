<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\RealEstateCRM\Property;
class PropertyController extends Controller { public function index() { return Property::paginate(); } }