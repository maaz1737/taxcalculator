<?php

namespace App\Services\Fitness;

class BmrService
{
    public function calculate(array $d): array
    {
        $w = (float)$d['weight_kg'];
        $h = (float)$d['height_cm'];
        $a = (int)$d['age'];
        $sex = $d['sex'];

        $bmr = 10 * $w + 6.25 * $h - 5 * $a + ($sex === 'male' ? 5 : -161);

        return [
            'bmr' => (int) round($bmr),
            'formula' => 'Mifflin-St Jeor'
        ];
    }
}
