<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\GymManagement\MembershipPlan;
class MembershipPlanController extends Controller { public function index() { return MembershipPlan::paginate(); } }