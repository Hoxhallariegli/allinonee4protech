<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\EventManagement\Attendee;
class AttendeeController extends Controller { public function index() { return Attendee::paginate(); } }