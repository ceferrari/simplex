<?php

namespace App\Simplex\Repositories;

class HomeRepository
{
    private $tabela;

    public function createTable($request) {
        $variaveis = $request->get('variaveis');
        $restricoes = $request->get('restricoes');
        $this->tabela = null;

        for ($r = 1; $r <= $restricoes; $r++) {
            for ($v = 1; $v <= $variaveis; $v++) {
                $this->tabela['f'.$r]['x'.$v] = $request->get('r'.$r.'x'.$v);
            }

            for ($f = 1; $f <= $restricoes; $f++) {
                $this->tabela['f'.$r]['f'.$f] = ($f == $r) ? "1" : "0";
            }

            $this->tabela['f'.$r]['b'] = $request->get('b'.$r);
        }

        for ($v = 1; $v <= $variaveis; $v++) {
            $this->tabela['Z']['x'.$v] = strval($request->get('x'.$v) * -1);
        }

        for ($f = 1; $f <= $restricoes; $f++) {
            $this->tabela['Z']['f'.$f] = "0";
        }

        $this->tabela['Z']['b'] = "0";

        return $this->tabela;
    }

    public function lowestCoefficientColumn() {
        $row = $this->tabela['Z'];
        $min = min($row);

        return array_search($min, $row);
    }

    public function baseChange() {
        $col = $this->lowestCoefficientColumn();
        $min = PHP_INT_MAX;

        foreach ($this->tabela as $row) {
            if ($row[$col] > 0 && $row['b'] / $row[$col] < $min) {
                $min =  $row['b'] / $row[$col];
            }
        }

        return $min;
    }
}
