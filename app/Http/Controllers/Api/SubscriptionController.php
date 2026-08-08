<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\GymManagement\Subscription;
class SubscriptionController extends Controller { public function index() { return Subscription::paginate(); } }