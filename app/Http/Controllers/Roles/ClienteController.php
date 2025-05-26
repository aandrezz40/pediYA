<?php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {   
        $user = auth()->user();

        $favoriteStores = $user->favoriteStores()->with('user')->get(); 
        
        return view('cliente.homeCliente', compact('favoriteStores'));
    }
}
