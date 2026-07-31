<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\CRM\Company;
class CompanyController extends Controller { public function index() { return Company::paginate(); } }