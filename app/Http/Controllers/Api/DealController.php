<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\CRM\Deal;
class DealController extends Controller { public function index() { return Deal::paginate(); } }