<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\ConstructionERP\Material;
class MaterialController extends Controller { public function index() { return Material::paginate(); } }