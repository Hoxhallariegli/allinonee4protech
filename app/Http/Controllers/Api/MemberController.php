<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\GymManagement\Member;
class MemberController extends Controller { public function index() { return Member::paginate(); } }