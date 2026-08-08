<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\RealEstateCRM\ClientAddress;
class ClientAddressController extends Controller { public function index() { return ClientAddress::paginate(); } }