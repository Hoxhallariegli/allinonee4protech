<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\GymManagement\Trainer;
class TrainerController extends Controller { public function index() { return Trainer::paginate(); } }