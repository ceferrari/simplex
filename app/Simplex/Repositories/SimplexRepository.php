<?php

namespace App\Simplex\Repositories;

use App\Simplex\Repositories\TwoPhasesRepository as TwoPhases;

class SimplexRepository
{
    private $twoPhases;
    private $table;
    private $row;
    private $col;
    private $pivot;

    public function __construct(TwoPhases $twoPhases) {
        $this->twoPhases = $twoPhases;
    }

    public function solution($request) {
        $return = $this->iterate($request, true);
        return ($return == true) ? $this->table : $this->finalSolution($request);
    }

    public function finalSolution($request) {
        $this->iterate($request, false);
        if ($this->twoPhases->isOptimal($this->table)) {
            $request['table'] = $this->table;
            $this->table = $this->twoPhases->phaseTwo($request);
            //$this->iterate($request, false);
        }
        $solution = array_fill_keys(array_keys(current($this->table)), 0);
        foreach ($this->table as $key => $row) {
            $solution[$key] = $row['b'];
        }
        $solution['Z'] = ($request['objective'] == 'maximize') ? $this->table['Z']['b'] : $this->table['Z']['b'] * -1;
        unset($solution['b']);
        return $solution;
    }

    private function iterate($request, $return) {
        $this->table = $request['table'];
        $min = min($this->table['Z']);
        while ($min < 0 && $request['iterations']--) {
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
        $z = $this->table['Z'];
        unset($z['b']);
        $this->col = array_search(min($z), $z);
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
