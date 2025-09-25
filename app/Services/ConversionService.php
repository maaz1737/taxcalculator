<?php

namespace App\Services;

use InvalidArgumentException;

class ConversionService
{
    public function convert(string $category, string $from, string $to, float $value): float
    {
        $reg = config("units.$category");
        if (!$reg) throw new \InvalidArgumentException("Unknown category: $category");

        // Temperature = affine transform
        if ($category === 'temperature') {
            $u = $reg['units'];
            $fromSpec = $u[$from]['to_base']; // ['mul','add']
            $toSpec   = $u[$to]['to_base'];
            $vK  = ($value + $fromSpec['add']) * $fromSpec['mul'];   // to Kelvin
            $out = ($vK / $toSpec['mul']) - $toSpec['add'];          // from Kelvin
            return (float) number_format($out, 6, '.', '');
        }

        // Linear (length/area/weight/…)
        $u = $reg['units'];
        $base = $value * $u[$from]['to_base'];
        $out  = $base / $u[$to]['to_base'];
        return (float) number_format($out, 12, '.', '');
    }


    public function table(string $category, string $from, float $value): array
    {
        $reg = config("units.$category");
        $targets = $reg['common_targets'] ?? array_keys($reg['units'] ?? []);
        $rows = [];
        foreach ($targets as $to) {
            $rows[] = [
                'unit'  => $to,
                'value' => $this->convert($category, $from, $to, $value),
            ];
        }
        return $rows;
    }
}
