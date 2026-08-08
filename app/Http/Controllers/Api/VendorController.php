<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\ECommerce\Vendor;
class VendorController extends Controller { public function index() { return Vendor::paginate(); } }