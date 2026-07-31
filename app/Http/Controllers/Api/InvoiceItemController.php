<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\AutoRepairManagement\InvoiceItem;
class InvoiceItemController extends Controller { public function index() { return InvoiceItem::paginate(); } }