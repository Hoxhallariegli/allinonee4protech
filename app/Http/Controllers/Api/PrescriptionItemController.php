<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\PharmacyManagement\PrescriptionItem;
class PrescriptionItemController extends Controller { public function index() { return PrescriptionItem::paginate(); } }