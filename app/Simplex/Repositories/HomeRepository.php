<?php

namespace App\Simplex\Repositories;

class HomeRepository
{
    private $table;
    private $row;
    private $col;
    private $pivot;

    public function createTable($request) {
        $variables = $request->get('variables');
        $constraints = $request->get('constraints');
        $operation = $request->get('operation');
        $multiplier = ($operation == 'maximize') ? -1 : 1;

        for ($r = 1; $r <= $constraints; $r++) {
            for ($v = 1; $v <= $variables; $v++) {
                $this->table['f'.$r]['x'.$v] = $request->get('r'.$r.'x'.$v);
            }
            for ($f = 1; $f <= $constraints; $f++) {
                $this->table['f'.$r]['f'.$f] = ($f == $r) ? "1" : "0";
            }
            $this->table['f'.$r]['b'] = $request->get('b'.$r);
        }

        for ($v = 1; $v <= $variables; $v++) {
            $this->table['Z']['x'.$v] = strval($request->get('x'.$v) * $multiplier);
        }
        for ($f = 1; $f <= $constraints; $f++) {
            $this->table['Z']['f'.$f] = "0";
        }
        $this->table['Z']['b'] = "0";

        return $this->table;
    }

    public function solution($table, $iterations, $operation) {
        $this->table = $table;
        $min = min($this->table['Z']);
        $count = 0;

        while ($min < 0 && $count++ < $iterations) {
            $this->execute();
            $min = min($this->table['Z']);
        }

        foreach(current($this->table) as $key => $value) {
            if ($key != 'b') {
                $solution[$key] = "0";
            }
        }

        foreach ($this->table as $key => $row) {
            // if ($row['b'] > 0 && !preg_match('/f/', $key)) {
                if ($key == 'Z' && $operation == 'minimize') {
                    $solution[$key] = strval($row['b'] * -1);
                }
                else {
                    $solution[$key] = $row['b'];
                }
            // }
        }

        return $solution;
    }

    public function execute() {
        $this->findColumn();
        $this->findRowAndPivot();
        $this->switchRowCol();
        $this->divByPivot();
        $this->nullifyColumn();
    }

    private function findColumn() {
        $z = $this->table['Z'];
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
            $pivotRow[$key] = strval($value / $this->pivot);
        }
    }

    private function nullifyColumn() {
        $pivotRow = &$this->table[$this->row];
        foreach ($this->table as &$currentRow) {
            if ($currentRow[$this->col] != 0 && $currentRow != $pivotRow) {
                $multiplier = $currentRow[$this->col] * -1;
                foreach ($currentRow as $key => $value) {
                    $currentRow[$key] = strval($pivotRow[$key] * $multiplier + $value);
                }
            }
        }
    }
}
