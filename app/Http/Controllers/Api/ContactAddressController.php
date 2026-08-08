<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\CRM\ContactAddress;
class ContactAddressController extends Controller { public function index() { return ContactAddress::paginate(); } }