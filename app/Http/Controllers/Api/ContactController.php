<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\CRM\Contact;
class ContactController extends Controller { public function index() { return Contact::paginate(); } }