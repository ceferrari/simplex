<?php

namespace App\Simplex\Repositories;

use App\Simplex\Repositories\TableRepository as Table;

class TwoPhasesRepository
{
    public function __construct() {
        $this->table = \Session::get('table');
        $this->rowZ = \Session::get('rowZ');
        $this->operators = \Session::get('operators');
        $this->objective = \Session::get('objective');
    }

    public function phaseOne() {
        if (\Session::get('twoPhases') == 'true') {
            return $this->phaseOneStepOne();
        }
        return (new Table())->create();
    }

    private function phaseOneStepOne() {
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
        $table = (new Table())->create();
        foreach ($this->operators as $key => $value) {
            echo $key . " " . $value;
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

    public function phaseTwo($table) {
        return $this->phaseTwoStepTwo($this->phaseTwoStepOne($table));
    }

    private function phaseTwoStepOne($table) {
        foreach ($table as $row => $vRow) {
            foreach ($vRow as $col => $vCol) {
                if (preg_match('/a/', $col)) {
                    unset($table[$row][$col]);
                }
            }
        }
        foreach ($this->rowZ as $key => $value) {
            $table['Z'][$key] = $value * -1;
        }
        return $table;
    }

    private function phaseTwoStepTwo($table) {
        foreach ($table as $row => $vRow) {
            if (preg_match('/x/', $row)) {
                $multiplier = $table['Z'][$row] * -1;
                foreach ($vRow as $col => $vCol) {
                    $table['Z'][$col] += $vCol * $multiplier;
                }
            }
        }
        if ($this->objective == 'minimize') {
            foreach ($table['Z'] as $key => $value) {
                $table['Z'][$key] *= -1;
                $table['Z'][$key] += 0;
            }
        }
        return $table;
    }
}
