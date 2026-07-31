<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\CRM\Lead;
class LeadController extends Controller { public function index() { return Lead::paginate(); } }