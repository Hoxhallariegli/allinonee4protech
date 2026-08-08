<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\LegalManagement\LegalCase;
class LegalCaseController extends Controller { public function index() { return LegalCase::paginate(); } }