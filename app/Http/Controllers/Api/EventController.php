<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\EventManagement\Event;
class EventController extends Controller { public function index() { return Event::paginate(); } }