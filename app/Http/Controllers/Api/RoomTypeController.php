<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\HotelManagement\RoomType;
class RoomTypeController extends Controller { public function index() { return RoomType::paginate(); } }