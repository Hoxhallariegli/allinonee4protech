<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\CRM\Task;
class TaskController extends Controller { public function index() { return Task::paginate(); } }