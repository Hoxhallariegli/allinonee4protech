<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\InvoiceItem;
class InvoiceItemController extends Controller { public function index() { return InvoiceItem::paginate(); } }