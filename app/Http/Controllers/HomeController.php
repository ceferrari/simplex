<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Simplex\Repositories\HomeRepository as Home;
use App\Simplex\Repositories\SimplexRepository as Simplex;
use App\Simplex\Repositories\TwoPhasesRepository as TwoPhases;

class HomeController extends Controller
{
    private $home;
    private $simplex;
    private $twoPhases;

    public function __construct(Home $home, Simplex $simplex, TwoPhases $twoPhases) {
        $this->home = $home;
        $this->simplex = $simplex;
        $this->twoPhases = $twoPhases;
    }

    public function index() {
        return view('settings');
    }

    public function getSettings() {
        return view('settings');
    }

    public function postSettings(Request $request) {
        $request->session()->set('variables', $request->get('variables'));
        $request->session()->set('constraints', $request->get('constraints'));
        $request->session()->set('iterations', $request->get('iterations'));
        $request->session()->set('objective', $request->get('objective'));
        return redirect('variables');
    }

    public function getVariables(Request $request) {
        $variables = $request->session()->get('variables');
        $constraints = $request->session()->get('constraints');
        $iterations = $request->session()->get('iterations');
        $objective = $request->session()->get('objective');
        return view('variables', compact('variables', 'constraints', 'iterations', 'objective'));
    }

    public function postVariables(Request $request) {
        if ($request->get('twoPhases') == 'true') {
            $request->session()->set('twoPhasesZ', $request->get('table')['z']);
            $table = $this->twoPhases->phaseOneStepOne($request->all());
        }
        else {
            $table = $this->home->createTable($request->all());
        }
        $request->session()->set('twoPhases', $request->get('twoPhases'));
        $request->session()->set('table', $table);
        return redirect('table');
    }

    public function getTable(Request $request) {
        $table = $request->session()->get('table');
        return view('table', compact('table'));
    }

    public function postTable(Request $request) {
        if ($request->session()->get('twoPhases') == 'true') {
            $request->session()->set('twoPhases', 'false');
            $request->session()->set('table', $this->twoPhases->phaseOneStepTwo($request->session()->all()));
            return redirect('table');
        }
        $table = $this->simplex->solution($request->session()->all());
        $iterations = $request->session()->get('iterations');
        $request->session()->set('iterations', --$iterations);
        if (is_array(current($table))) {
            $request->session()->set('table', $table);
            return redirect('table');
        }
        $request->session()->set('solution', $table);
        return redirect('solution');
    }

    public function getSolution(Request $request) {
        $solution = $request->session()->get('solution');
        return view('solution', compact('solution'));
    }

    public function postSolution(Request $request) {
        return redirect('settings');
    }

    public function postFinalSolution(Request $request) {
        if ($request->session()->get('twoPhases') == 'true') {
            $request->session()->set('table', $this->twoPhases->phaseOneStepTwo($request->session()->all()));
        }
        $request->session()->set('solution', $this->simplex->finalSolution($request->session()->all()));
        return redirect('solution');
    }
}
