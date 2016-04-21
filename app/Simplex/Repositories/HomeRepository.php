<?php

namespace App\Simplex\Repositories;

class HomeRepository
{
    public function createTable($request) {
        $request['table']['z']['B'] = 0;
        $table = $request['table'];
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
        if ($request['objective'] == 'maximize') {
            foreach ($table['Z'] as $key => $value) {
                $table['Z'][$key] *= -1;
            }
        }
        return $table;
    }
}
