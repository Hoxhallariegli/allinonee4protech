<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\ConstructionERP\Project;
class ProjectController extends Controller { public function index() { return Project::paginate(); } }