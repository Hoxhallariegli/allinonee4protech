<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\LegalManagement\Document;
class DocumentController extends Controller { public function index() { return Document::paginate(); } }