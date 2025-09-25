<?php

namespace App\Services\Fitness;

class MacrosService
{
    public function calculate(array $d): array
    {
        $cal = (int)$d['calories'];
        $carb = (float)$d['carb_pct'] / 100.0;
        $prot = (float)$d['protein_pct'] / 100.0;
        $fat  = (float)$d['fat_pct'] / 100.0;

        $carb_g = round(($cal * $carb) / 4);
        $prot_g = round(($cal * $prot) / 4);
        $fat_g  = round(($cal * $fat) / 9);

        return [
            'carbs_g'   => (int)$carb_g,
            'protein_g' => (int)$prot_g,
            'fat_g'     => (int)$fat_g,
        ];
    }
}
