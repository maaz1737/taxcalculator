<?php

namespace App\Services\Fitness;

class BodyFatService
{
    public function calculate(array $d): array
    {
        $sex   = $d['sex'];
        $h_cm  = (float)$d['height_cm'];
        $w_cm  = (float)$d['waist_cm'];
        $n_cm  = (float)$d['neck_cm'];
        $hip_cm = isset($d['hip_cm']) ? (float)$d['hip_cm'] : null;

        // cm -> inches
        $h = $h_cm / 2.54;
        $w = $w_cm / 2.54;
        $n = $n_cm / 2.54;
        $hip = $hip_cm ? $hip_cm / 2.54 : null;

        if ($sex === 'male') {
            $bf = 86.010 * log10($w - $n) - 70.041 * log10($h) + 36.76;
        } else {
            $bf = 163.205 * log10($w + ($hip ?? 0) - $n) - 97.684 * log10($h) - 78.387;
        }

        $bf = max(0, min(75, $bf)); // clamp
        return [
            'body_fat_pct' => round($bf, 1),
            'method' => 'US Navy',
        ];
    }
}
