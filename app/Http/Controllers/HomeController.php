<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Simplex\Repositories\HomeRepository as Repository;

class HomeController extends Controller
{
    private $repository;

    public function __construct(Repository $repository) {
        $this->repository = $repository;
    }

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
        $tabela = $this->repository->createTable($request);

        //dd($tabela);

        // $row[] = $tabela['Z'];
        dd($this->repository->baseChange());

        return view('home', compact('tabela'));
    }
}
