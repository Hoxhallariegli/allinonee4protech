<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\BerberApp\Booking;
class BookingController extends Controller { public function index() { return Booking::paginate(); } }