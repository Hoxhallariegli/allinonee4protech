<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\GymManagement\ClassSchedule;
class ClassScheduleController extends Controller { public function index() { return ClassSchedule::paginate(); } }