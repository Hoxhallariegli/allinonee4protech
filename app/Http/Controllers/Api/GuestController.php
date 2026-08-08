<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\HotelManagement\Guest;
class GuestController extends Controller { public function index() { return Guest::paginate(); } }