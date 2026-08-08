<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\HotelManagement\Housekeeping;
class HousekeepingController extends Controller { public function index() { return Housekeeping::paginate(); } }