<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\HumanResources\LeaveRequest;
class LeaveRequestController extends Controller { public function index() { return LeaveRequest::paginate(); } }