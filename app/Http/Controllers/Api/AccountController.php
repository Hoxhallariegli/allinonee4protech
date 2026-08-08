<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Finance\Account;
class AccountController extends Controller { public function index() { return Account::paginate(); } }