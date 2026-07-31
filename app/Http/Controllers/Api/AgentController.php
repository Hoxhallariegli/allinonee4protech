<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\RealEstateCRM\Agent;
class AgentController extends Controller { public function index() { return Agent::paginate(); } }