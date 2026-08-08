<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\AgricultureManagement\Field;
class FieldController extends Controller { public function index() { return Field::paginate(); } }