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

    public function settings(Request $request) {
        $variables = $request->get('variables');
        $constraints = $request->get('constraints');
        $iterations = $request->get('iterations');
        $operation = $request->get('operation');

        \Session::set('variables', $variables);
        \Session::set('constraints', $constraints);
        \Session::set('iterations', $iterations);
        \Session::set('operation', $operation);

        return view('home', compact('variables', 'constraints', 'iterations', 'operation'));
    }

    public function variables(Request $request) {
        $table = $this->repository->createTable($request);

        \Session::set('table', $table);

        return view('home', compact('table'));
    }

    public function table() {
        $table = \Session::get('table');
        $iterations = \Session::get('iterations');
        $operation = \Session::get('operation');
        $solution = $this->repository->solution($table, $iterations, $operation);
        uksort($solution, array($this, "cmp"));

        \Session::set('solution', $solution);

        return view('home', compact('solution'));
    }

    private function cmp($a, $b) {
        $a = preg_replace('/f/', 'y', $a);
        $b = preg_replace('/f/', 'y', $b);
        return strcasecmp($a, $b);
    }
}
