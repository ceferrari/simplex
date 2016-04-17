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
        return view('settings');
    }

    public function getSettings() {
        return view('settings');
    }

    public function postSettings(Request $request) {
        \Session::set('variables', $request->get('variables'));
        \Session::set('constraints', $request->get('constraints'));
        \Session::set('iterations', $request->get('iterations'));
        \Session::set('operation', $request->get('operation'));
        return redirect('variables');
    }

    public function getVariables() {
        $variables = \Session::get('variables');
        $constraints = \Session::get('constraints');
        return view('variables', compact('variables', 'constraints'));
    }

    public function postVariables(Request $request) {
        \Session::set('table', $this->repository->createTable($request));
        return redirect('table');
    }

    public function getTable() {
        $table = \Session::get('table');
        return view('table', compact('table'));
    }

    public function postTable() {
        $solution = $this->repository->solution(\Session::get('table'), \Session::get('iterations'), \Session::get('operation'));
        uksort($solution, array($this, "cmp"));
        \Session::set('solution', $solution);
        return redirect('solution');
    }

    public function getSolution() {
        $solution = \Session::get('solution');
        return view('solution', compact('solution'));
    }

    private function cmp($a, $b) {
        $a = preg_replace('/f/', 'y', $a);
        $b = preg_replace('/f/', 'y', $b);
        return strcasecmp($a, $b);
    }
}
