<?php

namespace App\Services\Finance;

class RentAffordabilityService
{
    public function calculate(array $in): array
    {
        $income              = max(0.0, (float)($in['monthly_income'] ?? 0));
        $incomeIsGross       = (bool)($in['income_is_gross'] ?? true);
        $debts               = max(0.0, (float)($in['monthly_debts'] ?? 0));
        $rule                = (string)($in['rule'] ?? 'dti_36');
        $customPercent       = isset($in['custom_percent']) ? max(0.0, min(100.0, (float)$in['custom_percent'])) : null;
        $utilities           = max(0.0, (float)($in['utilities_monthly'] ?? 0));
        $insurance           = max(0.0, (float)($in['insurance_monthly'] ?? 0));
        $targetSavingsPct    = isset($in['target_savings_percent']) ? max(0.0, min(100.0, (float)$in['target_savings_percent'])) : 0.0;
        $showRanges          = (bool)($in['show_ranges'] ?? true);

        $reserve   = $income * ($targetSavingsPct / 100.0);
        $incomeAdj = max(0.0, $income - $reserve);

        $notes = [];
        if ($targetSavingsPct > 0) {
            $notes[] = 'Savings target reserved first';
        }

        // Candidate formulas
        $maxRent30 = 0.30 * $incomeAdj;
        $maxRentDti = (0.36 * $incomeAdj) - $debts;
        $methodUsed = $rule;

        if ($rule === '30_percent') {
            $maxRent = $maxRent30;
            $notes[] = '30% of adjusted income rule';
        } elseif ($rule === 'custom_percent') {
            $p = $customPercent ?? 30.0;
            $maxRent = ($p / 100.0) * $incomeAdj;
            $notes[] = "Custom percent rule at {$p}% of adjusted income";
        } else {
            // default/fallback to DTI 36
            $methodUsed = 'dti_36';
            $maxRent    = $maxRentDti;
            $notes[]    = 'Max rent capped so total DTI ≤ 36%';
        }

        $maxRent = round(max(0.0, $maxRent), 2);

        $rentToIncome = $incomeAdj > 0 ? $maxRent / $incomeAdj : 0.0;
        $totalDti     = $incomeAdj > 0 ? ($maxRent + $debts) / $incomeAdj : 0.0;

        $housingTotal = round($maxRent + $utilities + $insurance, 2);

        $payloadEcho = [
            'monthly_income'         => $income,
            'income_is_gross'        => $incomeIsGross,
            'monthly_debts'          => $debts,
            'rule'                   => $methodUsed,
            'custom_percent'         => $customPercent,
            'utilities_monthly'      => $utilities,
            'insurance_monthly'      => $insurance,
            'target_savings_percent' => $targetSavingsPct,
            'show_ranges'            => $showRanges,
            'saving_target' => $reserve
        ];

        $res = [
            'inputs_echo' => $payloadEcho,
            'max_rent'    => $maxRent,
            'method_used' => $methodUsed,
            'ratios'      => [
                'rent_to_income' => round($rentToIncome, 4),
                'total_dti'      => round($totalDti, 4),
            ],
            'housing_costs' => [
                'rent'        => $maxRent,
                'utilities'   => round($utilities, 2),
                'insurance'   => round($insurance, 2),
                'total_housing' => $housingTotal,
            ],
            // Return ratios (as requested). Frontend can multiply by incomeAdj if it wants amounts.
            'ranges' => $showRanges ? [
                'conservative' => 0.25,
                'moderate'     => 0.30,
                'aggressive'   => 0.35,
            ] : null,
            'notes' => $notes,
        ];

        return $res;
    }
}
