<?php

namespace App\Http\Controllers;
use App\Models\Barrio;
use Illuminate\Http\Request;

class BarriosController extends Controller
{
    public function index(){
        $barrios = Barrio::all();
        return view('auth.register', compact('barrios'));
    }
}
