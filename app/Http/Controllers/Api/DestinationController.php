<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\TravelAgency\Destination;
class DestinationController extends Controller { public function index() { return Destination::paginate(); } }