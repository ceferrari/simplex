<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class HomeController extends Controller
{
    public function index() {
        return view('home');
    }

    public function back(Request $request) {
        return back();
    }

    public function form(Request $request) {
        $variaveis = $request->get('variaveis');
        $restricoes = $request->get('restricoes');

        return view('home', compact('variaveis', 'restricoes'));
    }
}