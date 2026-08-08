<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\HotelManagement\Reservation;
class ReservationController extends Controller { public function index() { return Reservation::paginate(); } }