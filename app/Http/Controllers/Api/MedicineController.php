<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\PharmacyManagement\Medicine;
class MedicineController extends Controller { public function index() { return Medicine::paginate(); } }