<?php

namespace App\Services\Fitness;

class TdeeService
{
    private array $factors = [
        'sedentary' => 1.2,
        'light'     => 1.375,
        'moderate'  => 1.55,
        'active'    => 1.725,
        'very'      => 1.9,
    ];

    public function calculate(array $d): array
    {
        $bmr = (float)$d['bmr'];
        $act = $d['activity'];
        $factor = $this->factors[$act] ?? 1.2;

        return [
            'tdee' => (int) round($bmr * $factor),
            'factor' => $factor,
        ];
    }
}
