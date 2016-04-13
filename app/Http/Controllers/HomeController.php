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

    public function variables(Request $request) {
        $variables = $request->get('variables');
        $constraints = $request->get('constraints');
        $iterations = $request->get('iterations');

        \Session::set('variables', $variables);
        \Session::set('constraints', $constraints);
        \Session::set('iterations', $iterations);

        return view('home', compact('variables', 'constraints', 'iterations'));
    }

    public function table(Request $request) {
        $table = $this->repository->createTable($request);

        \Session::set('table', $table);

        return view('home', compact('table'));
    }

    public function solution() {
        $table = \Session::get('table');
        $iterations = \Session::get('iterations');
        $solution = $this->repository->solution($table, $iterations);
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
