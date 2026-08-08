<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\ConstructionERP\HeavyMachinery;
class HeavyMachineryController extends Controller { public function index() { return HeavyMachinery::paginate(); } }