<?php

namespace App\Simplex\Repositories;

class HomeRepository
{
    public function createTable() {
        $objective = \Session::get('objective');
        $table = \Session::get('table');
        $table['z']['B'] = 0;
        foreach ($table as $row => $vRow) {
            foreach ($table as $col => $vCol) {
                $table[$row][$col] = intval($row == $col);
            }
            $table[$row]['b'] = $table[$row]['B'];
            unset($table[$row]['B']);
            unset($table[$row]['z']);
        }
        $table['Z'] = $table['z'];
        unset($table['z']);
        if ($objective == 'maximize') {
            foreach ($table['Z'] as $key => $value) {
                $table['Z'][$key] *= -1;
            }
        }
        return $table;
    }
}
