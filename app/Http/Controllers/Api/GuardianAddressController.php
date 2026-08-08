<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\SchoolManagement\GuardianAddress;
class GuardianAddressController extends Controller { public function index() { return GuardianAddress::paginate(); } }