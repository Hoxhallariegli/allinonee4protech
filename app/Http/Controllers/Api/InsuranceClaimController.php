<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\AutoRepairManagement\InsuranceClaim;
class InsuranceClaimController extends Controller { public function index() { return InsuranceClaim::paginate(); } }