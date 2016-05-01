<?php

namespace App\Simplex\Repositories;

class TableRepository
{
    public function __construct() {
        $this->objective = \Session::get('objective');
        $this->table = \Session::get('table');
        $this->table['z']['B'] = 0;
    }

    public function create() {
        foreach ($this->table as $row => $vRow) {
            foreach ($vRow as $col => $vCol) {
                $this->table[$row][$col] = str_replace(',', '.', $vCol);
            }
            foreach ($this->table as $col => $vCol) {
                $this->table[$row][$col] = intval($row == $col);
            }
            $this->table[$row]['b'] = $this->table[$row]['B'];
            unset($this->table[$row]['B']);
            unset($this->table[$row]['z']);
        }
        $this->table['Z'] = $this->table['z'];
        unset($this->table['z']);
        $this->changeSigns();
        return $this->table;
    }

    private function changeSigns() {
        foreach ($this->table as $row => $vRow) {
            if ($vRow['b'] < 0 && $row != 'Z') {
                foreach ($vRow as $col => $vCol) {
                    if (preg_match('/x/', $col) || preg_match('/b/', $col)) {
                        $this->table[$row][$col] *= -1;
                    }
                }
            }
        }
        if ($this->objective == 'maximize') {
            foreach ($this->table['Z'] as $key => $value) {
                $this->table['Z'][$key] *= -1;
            }
        }
    }
}
