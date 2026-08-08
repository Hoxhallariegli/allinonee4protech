<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\ConstructionERP\Equipment;
class EquipmentController extends Controller { public function index() { return Equipment::paginate(); } }