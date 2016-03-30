<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class HomeController extends Controller
{
    public function index() {
    	return view('home');
    }

    public function store(Request $request) {
    	$variaveis = $request->get('variaveis');
    	$restricoes = $request->get('restricoes');

    	return view('variables', compact('variaveis', 'restricoes'));
    }
}
