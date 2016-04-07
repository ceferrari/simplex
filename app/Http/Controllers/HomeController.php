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

    public function variables(Request $request) {
        $variaveis = $request->get('variaveis');
        $restricoes = $request->get('restricoes');

        return view('home', compact('variaveis', 'restricoes'));
    }

    public function table(Request $request) {
        $variaveis = $request->get('variaveis');
        $restricoes = $request->get('restricoes');

        $tabela = null;

        for ($r = 1; $r <= $restricoes; $r++) {
            $row = 'f'.$r;

            for ($v = 1; $v <= $variaveis; $v++) {
                $tabela[$row]['x'.$v] = $request->get('r'.$r.'x'.$v);
            }

            for ($f = 1; $f <= $restricoes; $f++) {
                $tabela[$row]['f'.$f] = $f == $r ? "1" : "0";
            }

            $tabela[$row]['b'] = $request->get('b'.$r);
        }

        for ($v = 1; $v <= $variaveis; $v++) {
            $tabela['Z']['x'.$v] = strval($request->get('x'.$v) * -1);
        }

        for ($f = 1; $f <= $restricoes; $f++) {
            $tabela['Z']['f'.$f] = "0";
        }

        $tabela['Z']['b'] = "0";

        //dd($tabela);

        return view('home', compact('tabela'));
    }
}
