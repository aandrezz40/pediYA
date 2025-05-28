<?php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TenderoController extends Controller
{
    public function index()
    {
        return view('tendero.homeTendero');
    }
}
