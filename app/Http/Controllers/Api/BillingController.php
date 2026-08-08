<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\LegalManagement\Billing;
class BillingController extends Controller { public function index() { return Billing::paginate(); } }