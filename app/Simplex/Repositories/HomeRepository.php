<?php

namespace App\Simplex\Repositories;

use Illuminate\Http\Request;

class HomeRepository
{
    private $table;
    private $row;
    private $col;
    private $pivot;

    public function createTable(Request $request) {
        $variaveis = $request->get('variaveis');
        $restricoes = $request->get('restricoes');

        for ($r = 1; $r <= $restricoes; $r++) {
            for ($v = 1; $v <= $variaveis; $v++) {
                $this->table['f'.$r]['x'.$v] = $request->get('r'.$r.'x'.$v);
            }

            for ($f = 1; $f <= $restricoes; $f++) {
                $this->table['f'.$r]['f'.$f] = ($f == $r) ? "1" : "0";
            }

            $this->table['f'.$r]['b'] = $request->get('b'.$r);
        }

        for ($v = 1; $v <= $variaveis; $v++) {
            $this->table['Z']['x'.$v] = strval($request->get('x'.$v) * -1);
        }

        for ($f = 1; $f <= $restricoes; $f++) {
            $this->table['Z']['f'.$f] = "0";
        }

        $this->table['Z']['b'] = "0";

        return $this->table;
    }

    public function getTable() {
        return $this->table;
    }

    public function solution() {
        $min = min($this->table['Z']);
        $solution = null;

        while ($min < 0) {
            $this->execute();
            $min = min($this->table['Z']);
        }

        foreach ($this->table as $key => $row) {
            if ($row['b'] != 0) {
                $solution[$key] = $row['b'];
            }
        }

        return $solution;
    }

    public function execute() {
        $this->findColumn();
        $this->findRow();
        $this->switchRowCol();
        $this->divByPivot();
        $this->nullifyColumn();
    }

    private function findColumn() {
        $z = $this->table['Z'];
        $min = min($z);

        $this->col = array_search($min, $z);
    }

    private function findRow() {
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
                    $currentRow[$key] = $pivotRow[$key] * $multiplier + $value;
                }
            }
        }
    }
}
