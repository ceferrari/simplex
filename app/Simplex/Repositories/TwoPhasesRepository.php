<?php

namespace App\Simplex\Repositories;

use App\Simplex\Repositories\HomeRepository as Home;

class TwoPhasesRepository
{
    private $home;

    public function __construct(Home $home) {
        $this->home = $home;
    }

    public function phaseOneStepOne($request) {
        foreach ($request['operators'] as $key => $value) {
            if ($value == 'less') {
                $table['f'.$key] = $request['table']['f'.$key];
            }
            if ($value == 'greater') {
                $table['e'.$key] = $request['table']['f'.$key];
            }
            if ($value == 'equal' || $value == 'greater') {
                $table['a'.$key] = $request['table']['f'.$key];
            }
        }
        $table['z'] = $request['table']['z'];
        $request['table'] = $table;
        $table = $this->home->createTable($request);
        foreach ($request['operators'] as $key => $value) {
            if ($value == 'greater') {
                $table['a'.$key]['e'.$key] = -1;
                unset($table['e'.$key]);
            }
        }
        foreach ($table['Z'] as $key => $value) {
            $table['Z'][$key] = 0;
            if (preg_match('/a/', $key)) {
                $table['Z'][$key] = -1;
            }
        }
        return $table;
    }

    public function phaseOneStepTwo($request) {
        $table = $request['table'];
        foreach ($table as $row => $vRow) {
            if (preg_match('/a/', $row)) {
                foreach ($table[$row] as $col => $vCol) {
                    $table['Z'][$col] += $vCol;
                }
            }
        }
        foreach ($table['Z'] as $key => $value) {
            $table['Z'][$key] *= -1;
        }
        return $table;
    }

    public function isOptimal($table) {
        $hasArtifical = false;
        foreach ($table['Z'] as $key => $value) {
            if (preg_match('/a/', $key)) {
                $hasArtifical = true;
            }
        }
        return (min($table['Z']) >= 0 && $hasArtifical);
    }

    public function phaseTwo($request) {
        $table = $this->phaseTwoStepOne($request['table'], $request['twoPhasesZ']);
        return $this->phaseTwoStepTwo($table);
    }

    private function phaseTwoStepOne($table, $z) {
        foreach ($table as $row => $vRow) {
            foreach ($table[$row] as $col => $vCol) {
                if (preg_match('/x/', $col) && $row == 'Z') {
                    $table['Z'][$col] = $z[$col] * -1;
                }
                if (preg_match('/a/', $col)) {
                    unset($table[$row][$col]);
                }
            }
        }
        return $table;
    }

    private function phaseTwoStepTwo($table) {
        foreach ($table as $row => $vRow) {
            if (preg_match('/x/', $row) && $table['Z'][$row] < 0) {
                $multiplier = $table['Z'][$row] * -1;
                foreach ($vRow as $col => $vCol) {
                    $table['Z'][$col] += $vCol * $multiplier;
                }
            }
        }
        return $table;
    }
}
