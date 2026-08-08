<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\AutoRepairManagement\CustomerAddress;
class CustomerAddressController extends Controller { public function index() { return CustomerAddress::paginate(); } }