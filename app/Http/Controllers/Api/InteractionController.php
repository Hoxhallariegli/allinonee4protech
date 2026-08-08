<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\CRM\Interaction;
class InteractionController extends Controller { public function index() { return Interaction::paginate(); } }