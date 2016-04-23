<?php

namespace App\Simplex\Repositories;

class SensitivityRepository
{
    public function createTable($request) {
        $table = $request['table'];
        foreach ($table['Z'] as $key => $value) {
            if (preg_match('/f/', $key) || preg_match('/e/', $key)) {
                $aux = $request['columnB'][substr($key, -1)-1];
                $bounds = $this->calcBounds($table, $key);
                $sensitivity[$key]['ov'] = $aux;
                $sensitivity[$key]['ev'] = (isset($table[$key]) ? $table[$key]['b'] : 0);
                $sensitivity[$key]['sp'] = $value;
                $sensitivity[$key]['lb'] = $aux + $bounds['lower'];
                $sensitivity[$key]['ub'] = (isset($table[$key])) ? '∞' : $aux + $bounds['upper'];
            }
        }
        return $sensitivity;
    }

    private function calcBounds($table, $key) {
        unset($table['Z']);
        $columnF = array_column($table, $key);
        $columnB = array_column($table, 'b');
        foreach ($columnB as $key => $value) {
            $delta[$key] = ($columnF[$key] == 0) ? 0 : $value / $columnF[$key] * -1;
        }
        foreach ($delta as $key => $value) {
            if ($value < 0) {
                $aux['lower'][$key] = $value;
            }
            if ($value > 0) {
                $aux['upper'][$key] = $value;
            }
        }
        $lower = isset($aux['lower']) ? max($aux['lower']) : 0;
        $upper = isset($aux['upper']) ? min($aux['upper']) : 0;
        return ['lower' => $lower, 'upper' => $upper];
    }
}
