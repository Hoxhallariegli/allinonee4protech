<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\TravelAgency\FlightTicket;
class FlightTicketController extends Controller { public function index() { return FlightTicket::paginate(); } }