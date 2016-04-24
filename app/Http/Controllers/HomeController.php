<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Simplex\Repositories\HomeRepository as Home;
use App\Simplex\Repositories\SimplexRepository as Simplex;
use App\Simplex\Repositories\TwoPhasesRepository as TwoPhases;
use App\Simplex\Repositories\SensitivityRepository as Sensitivity;

class HomeController extends Controller
{
    private $home;
    private $simplex;
    private $twoPhases;
    private $Sensitivity;

    public function __construct(Home $home, Simplex $simplex, TwoPhases $twoPhases, Sensitivity $sensitivity) {
        $this->home = $home;
        $this->simplex = $simplex;
        $this->twoPhases = $twoPhases;
        $this->sensitivity = $sensitivity;
    }

    public function getSettings(Request $request) {
        return view('settings');
    }

    public function getVariables(Request $request) {
        return view('variables')->with($request->session()->all());
    }

    public function getTable(Request $request) {
        return view('table')->with('table', $request->session()->get('table'));
    }

    public function getSolution(Request $request) {
        return view('solution')->with('solution', $request->session()->get('solution'));
    }

    public function getSensitivity(Request $request) {
        return view('sensitivity')->with('sensitivity', $request->session()->get('sensitivity'));
    }

    public function postSettings(Request $request) {
        $request->session()->set('variables', $request->get('variables'));
        $request->session()->set('constraints', $request->get('constraints'));
        $request->session()->set('iterations', $request->get('iterations'));
        $request->session()->set('objective', $request->get('objective'));
        return redirect('variables');
    }

    public function postVariables(Request $request) {
        $request->session()->set('toFractions', 'on');
        $request->session()->set('table', $request->get('table'));
        $request->session()->set('columnB', array_column($request->get('table'), 'B'));
        $request->session()->set('twoPhases', $request->get('twoPhases'));
        if ($request->get('twoPhases') == 'true') {
            $request->session()->set('twoPhasesZ', $request->get('table')['z']);
            $table = $this->twoPhases->phaseOneStepOne();
        }
        else {
            $table = $this->home->createTable();
        }
        $request->session()->set('table', $table);
        return redirect('table');
    }

    public function postTable(Request $request) {
        $request->session()->set('toFractions', $request->get('toFractions'));
        if ($request->session()->get('twoPhases') == 'true') {
            $request->session()->set('twoPhases', 'false');
            $request->session()->set('table', $this->twoPhases->phaseOneStepTwo());
            return redirect('table');
        }
        $table = $this->simplex->solution();
        if (is_array(current($table))) {
            $request->session()->set('table', $table);
            return redirect('table');
        }
        $request->session()->set('solution', $table);
        return redirect('solution');
    }

    public function postSolution(Request $request) {
        $request->session()->set('toFractions', $request->get('toFractions'));
        $request->session()->set('sensitivity', $this->sensitivity->createTable());
        return redirect('sensitivity');
    }

    public function postFinalSolution(Request $request) {
        $request->session()->set('toFractions', $request->get('toFractions'));
        if ($request->session()->get('twoPhases') == 'true') {
            $request->session()->set('table', $this->twoPhases->phaseOneStepTwo());
        }
        $request->session()->set('solution', $this->simplex->finalSolution());
        return redirect('solution');
    }
}
