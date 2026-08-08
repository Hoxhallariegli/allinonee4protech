<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\EventManagement\TicketType;
class TicketTypeController extends Controller { public function index() { return TicketType::paginate(); } }