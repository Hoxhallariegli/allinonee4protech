<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\RealEstateCRM\Client;
class ClientController extends Controller { public function index() { return Client::paginate(); } }