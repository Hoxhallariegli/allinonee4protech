<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\RealEstateCRM\Contract;
class ContractController extends Controller { public function index() { return Contract::paginate(); } }