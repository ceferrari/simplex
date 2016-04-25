<?php

namespace App\Simplex\Repositories;

use App\Simplex\Repositories\TwoPhasesRepository as TwoPhases;

class SimplexRepository
{
    private $table;
    private $row;
    private $col;
    private $pivot;
    private $iterations;
    private $objective;

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
        $twoPhases = new TwoPhases();
        if ($twoPhases->isOptimal($this->table)) {
            $this->table = $twoPhases->phaseTwo($this->table);
            $this->iterate(true);
            return $this->table;
        }
        \Session::set('table', $this->table);
        $solution = array_fill_keys(array_keys($this->table['Z']), 0);
        foreach ($this->table as $key => $row) {
            $solution[$key] = $row['b'];
        }
        if ($this->objective == 'minimize') {
            $solution['Z'] *= -1;
        }
        unset($solution['b']);
        return $solution;
    }

    private function iterate($return) {
        $min = min($this->table['Z']);
        while ($min < 0 && $this->iterations--) {
            \Session::set('iterations', $this->iterations);
            $this->execute();
            $min = min($this->table['Z']);
            if ($return) {
                return true;
            }
        }
        return false;
    }

    private function execute() {
        $this->findColumn();
        $this->findRowAndPivot();
        $this->switchRowCol();
        $this->divByPivot();
        $this->nullifyColumn();
    }

    private function findColumn() {
        $z = array_diff($this->table['Z'], ['b' => $this->table['Z']['b']]);
        $min = min($z);
        if ($min >= 0) {
            \Session::set('hasSolution', 'false');
        }
        $this->col = array_search($min, $z);
    }

    private function findRowAndPivot() {
        $min = PHP_INT_MAX;
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
                    $currentRow[$key] = round($pivotRow[$key] * $multiplier + $value, 14);
                }
            }
        }
    }
}
