<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\LegalManagement\Hearing;
class HearingController extends Controller { public function index() { return Hearing::paginate(); } }