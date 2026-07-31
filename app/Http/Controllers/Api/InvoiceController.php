<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\AutoRepairManagement\Invoice;
class InvoiceController extends Controller { public function index() { return Invoice::paginate(); } }