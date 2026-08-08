<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\HotelManagement\HotelRoom;
class HotelRoomController extends Controller { public function index() { return HotelRoom::paginate(); } }