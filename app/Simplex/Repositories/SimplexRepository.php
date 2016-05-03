<?php

namespace App\Simplex\Repositories;

use App\Simplex\Repositories\TwoPhasesRepository as TwoPhases;

class SimplexRepository
{
    public function __construct() {
        $this->table = \Session::get('table');
        $this->iterations = \Session::get('iterations');
        $this->objective = \Session::get('objective');
    }

    private function isPhaseOne() {
        if (\Session::get('twoPhases') == 'true') {
            \Session::set('twoPhases', 'false');
            $this->table = (new TwoPhases())->phaseOneStepTwo();
            return true;
        }
        return false;
    }

    private function isPhaseTwo() {
        $this->findMin();
        if ($this->min >= 0 && $this->hasArtifical($this->z) && !$this->noSolution()) {
            $this->table = (new TwoPhases())->phaseTwo($this->table);
            return true;
        }
        return false;
    }

    public function solution($return) {
        if ($this->isPhaseOne()) {
            if ($return) {
                return $this->table;
            }
            $this->iterate(false);
        }
        if ($this->isPhaseTwo()) {
            if ($return) {
                return $this->table;
            }
            $this->iterate(false);
        }
        if ($this->iterate($return)) {
            return $this->table;
        }
        $solution = array_fill_keys(array_keys($this->z), 0);
        foreach ($this->table as $key => $row) {
            $solution[$key] = $row['b'];
        }
        if ($this->objective == 'minimize') {
            $solution['Z'] *= -1;
        }
        return $solution;
    }

    private function iterate($return) {
        $this->findMin();
        while ($this->min < 0 && $this->iterations--) {
            $this->execute();
            $this->findMin();
            if ($return) {
                return true;
            }
        }
        $this->setSessionValues();
        return false;
    }

    private function execute() {
        $this->findColumn();
        $this->findRowAndPivot();
        if ($this->row != PHP_INT_MAX) {
            $this->switchRowCol();
            $this->divByPivot();
            $this->nullifyColumn();
        }
        $this->setSessionValues();
    }

    private function findMin() {
        $this->z = $this->table['Z'];
        unset($this->z['b']);
        $this->min = min($this->z);
    }

    private function findColumn() {
        $this->col = array_search($this->min, $this->z);
    }

    private function findRowAndPivot() {
        $min = $this->row = $this->pivot = PHP_INT_MAX;
        foreach ($this->table as $key => $row) {
            $value = $row[$this->col];
            if ($value > 0 && $row['b'] / $value < $min) {
                $min = $row['b'] / $value;
                $this->row = $key;
                $this->pivot = $value;
            }
        }
    }

    private function switchRowCol() {
        $keys = array_keys($this->table);
        $keys[array_search($this->row, $keys)] = $this->col;
        $this->table = array_combine($keys, $this->table);
        $this->row = $this->col;
    }

    private function divByPivot() {
        $pivotRow = &$this->table[$this->row];
        foreach ($pivotRow as $key => $value) {
            $pivotRow[$key] = $value / $this->pivot;
        }
    }

    private function nullifyColumn() {
        $pivotRow = &$this->table[$this->row];
        foreach ($this->table as &$currentRow) {
            if ($currentRow[$this->col] != 0 && $currentRow != $pivotRow) {
                $multiplier = $currentRow[$this->col] * -1;
                foreach ($currentRow as $key => $value) {
                    $currentRow[$key] = round($pivotRow[$key] * $multiplier + $value, 15) + 0;
                }
            }
        }
    }

    private function setSessionValues() {
        \Session::set('table', $this->table);
        \Session::set('iterations', $this->iterations);
        \Session::set('solutionType', $this->noSolution() ? 'noSolution' : ($this->infSolutions() ? 'infinite' : 'optimal'));
    }

    private function hasArtifical($array) {
        foreach ($array as $key => $value) {
            if (preg_match('/a/', $key)) {
                return true;
            }
        }
        return false;
    }

    private function noSolution() {
        return $this->min >= 0 && $this->hasArtifical($this->table);
    }

    private function infSolutions() {
        return $this->min < 0 && $this->row == PHP_INT_MAX;
    }
}
