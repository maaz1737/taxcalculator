<?php

namespace App\Services\Fitness;

class IdealWeightService
{
    public function calculate(array $d): array
    {
        $sex = $d['sex'];
        $h_cm = (float)$d['height_cm'];
        $inches = $h_cm / 2.54;
        $over5 = max(0, $inches - 60);

        $base = $sex === 'male' ? 50.0 : 45.5;
        $ideal = $base + (2.3 * $over5);

        return [
            'ideal_weight_kg' => round($ideal, 1),
            'formula' => 'Devine'
        ];
    }
}
