<?php

namespace App\Services\Fitness;

class BmiService
{
    public function calculate(array $data): array
    {
        $unit   = $data['unit'];
        $height = (float)$data['height'];
        $weight = (float)$data['weight'];

        if ($unit === 'imperial') {
            $heightMeters = $height * 0.0254;     // inches -> meters
            $weightKg     = $weight * 0.45359237; // lbs -> kg
        } else {
            $heightMeters = $height / 100.0;      // cm -> meters
            $weightKg     = $weight;
        }

        $heightMeters = max($heightMeters, 0.01);
        $bmi = round($weightKg / ($heightMeters ** 2), 1);

        [$category, $advice] = $this->categoryAndAdvice($bmi);

        return [
            'bmi'      => $bmi,
            'category' => $category,
            'advice'   => $advice,
            'unit'     => $unit,
        ];
    }

    private function categoryAndAdvice(float $bmi): array
    {
        if ($bmi < 18.5) return ['Underweight', 'Consider a gradual calorie surplus and strength training.'];
        if ($bmi < 25)   return ['Normal', 'Maintain with balanced nutrition and regular activity.'];
        if ($bmi < 30)   return ['Overweight', 'Aim for a small deficit + consistent exercise.'];
        return ['Obese', 'Consult a professional ; focus on sustainable habits and monitoring.'];
    }
}
