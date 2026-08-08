<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\TravelAgency\TourBooking;
class TourBookingController extends Controller { public function index() { return TourBooking::paginate(); } }