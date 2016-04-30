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

    public function solution() {
        return $this->iterate(true) ? $this->table : $this->finalSolution();
    }

    public function finalSolution() {
        $this->iterate(false);
        if ($this->min >= 0 && $this->hasArtifical($this->z)) {
            return (new TwoPhases())->phaseTwo($this->table);
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
        $this->z = $this->table['Z'];
        unset($this->z['b']);
        $this->min = min($this->z);
        while ($this->min < 0 && $this->iterations--) {
            $this->execute();
            $this->min = min($this->z);
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
        if ($this->row != -1) {
            $this->switchRowCol();
            $this->divByPivot();
            $this->nullifyColumn();
        }
        $this->setSessionValues();
    }

    private function findColumn() {
        $this->col = array_search($this->min, $this->z);
    }

    private function findRowAndPivot() {
        $min = PHP_INT_MAX;
        $this->row = $this->pivot = -1;
        foreach ($this->table as $key => $row) {
            $value = $row[$this->col];
            if ($value > 0 &&  $row['b'] / $row[$this->col] < $min) {
                $min =   $row['b'] / $row[$this->col];
                $this->row = $key;
                $this->pivot = $value;
            }
        }
    }

    private function switchRowCol() {
        $keys = array_keys($this->table);
        $index = array_search($this->row, $keys);
        $keys[$index] = $this->col;
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
                    $currentRow[$key] = round($pivotRow[$key] * $multiplier + $value, 17);
                }
            }
        }
    }

    private function setSessionValues() {
        \Session::set('table', $this->table);
        \Session::set('iterations', $this->iterations);
        \Session::set('solutionType', ($this->min >= 0 && $this->hasArtifical($this->table)) ? 'noSolution' :
                                      ($this->min < 0 && $this->row == -1) ? 'infinite' : 'optimal');
    }

    private function hasArtifical($array) {
        foreach ($array as $key => $value) {
            if (preg_match('/a/', $key)) {
                return true;
            }
        }
        return false;
    }
}
