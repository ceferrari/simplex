<?php

namespace App\Simplex\Repositories;

use App\Simplex\Repositories\HomeRepository as Home;

class TwoPhasesRepository
{
    private $home;
    private $table;
    private $operators;
    private $twoPhasesZ;

    public function __construct(Home $home) {
        $this->home = $home;
        $this->table = \Session::get('table');
        $this->operators = \Session::get('operators');
        $this->twoPhasesZ = \Session::get('twoPhasesZ');
    }

    public function phaseOneStepOne() {
        foreach ($this->operators as $key => $value) {
            if ($value == 'less') {
                $table['f'.$key] = $this->table['f'.$key];
            }
            if ($value == 'greater') {
                $table['e'.$key] = $this->table['f'.$key];
            }
            if ($value == 'equal' || $value == 'greater') {
                $table['a'.$key] = $this->table['f'.$key];
            }
        }
        $table['z'] = $this->table['z'];
        \Session::set('table', $table);
        $table = $this->home->createTable();
        foreach ($this->operators as $key => $value) {
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

    public function phaseOneStepTwo() {
        foreach ($this->table as $row => $vRow) {
            if (preg_match('/a/', $row)) {
                foreach ($this->table[$row] as $col => $vCol) {
                    $this->table['Z'][$col] += $vCol;
                }
            }
        }
        foreach ($this->table['Z'] as $key => $value) {
            $this->table['Z'][$key] *= -1;
        }
        return $this->table;
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

    public function phaseTwo($table) {
        return $this->phaseTwoStepTwo($this->phaseTwoStepOne($table));
    }

    private function phaseTwoStepOne($table) {
        foreach ($table as $row => $vRow) {
            foreach ($table[$row] as $col => $vCol) {
                if (preg_match('/x/', $col) && $row == 'Z') {
                    $table['Z'][$col] = $this->twoPhasesZ[$col] * -1;
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
