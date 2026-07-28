<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Mechanic;
class MechanicController extends Controller { public function index() { return Mechanic::paginate(); } }