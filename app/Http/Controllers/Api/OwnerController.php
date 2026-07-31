<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\RealEstateCRM\Owner;
class OwnerController extends Controller { public function index() { return Owner::paginate(); } }