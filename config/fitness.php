<?php

return [
    'activity_factors' => [
        'sedentary' => 1.2,
        'light'     => 1.375,
        'moderate'  => 1.55,
        'very'      => 1.725,
        'athlete'   => 1.9,
    ],
    'macro_splits' => [
        'balanced'     => ['protein' => 25, 'carbs' => 50, 'fat' => 25],
        'high_protein' => ['protein' => 30, 'carbs' => 40, 'fat' => 30],
        'keto'         => ['protein' => 20, 'carbs' => 5,  'fat' => 75],
    ],
    'water' => [
        'baseline_ml_per_kg' => 32,
        'activity_per_30min' => [350, 700],
        'hot_multiplier'     => 1.12,
    ],
];
