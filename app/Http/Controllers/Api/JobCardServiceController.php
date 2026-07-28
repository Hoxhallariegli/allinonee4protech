<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\JobCardService;
class JobCardServiceController extends Controller { public function index() { return JobCardService::paginate(); } }