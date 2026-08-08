<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\EventManagement\Organizer;
class OrganizerController extends Controller { public function index() { return Organizer::paginate(); } }