<?php

namespace App\Services\Finance;

class IncomeTaxService
{

    function calculateIncomeTaxResident($income)
    {
        $tax = 0;

        // --- Base Tax Calculation ---
        if ($income <= 18200) {
            $tax = 0;
        } else if ($income <= 45000) {
            $tax = ($income - 18200) * 0.16;
        } else if ($income <= 135000) {
            $tax = 4288 + ($income - 45000) * 0.30;
        } else if ($income <= 190000) {
            $tax = 31288 + ($income - 135000) * 0.37;
        } else {
            $tax = 51638 + ($income - 190000) * 0.45;
        }

        // --- Low Income Tax Offset (LITO) ---
        $lito = 0;
        if ($income <= 37500) {
            $lito = 700;
        } elseif ($income <= 45000) {
            $lito = 700 - 0.05 * ($income - 37500);
        } elseif ($income < 66667) {
            $lito = 325 - 0.015 * ($income - 45000);
        } else {
            $lito = 0;
        }
        $finalTax = max(0, $tax - $lito);

        return round($finalTax, 2);
    }



    function calculateMedicareLevy($income, $levyPercent)
    {
        if (!$levyPercent) return 0;
        return $income * ($levyPercent / 100);
    }

    function calculateIncomeTaxNonIndividual($revenue, $cost)
    {
        // Calculate taxable income (cannot be negative)
        $taxableIncome = max(0, $revenue - $cost);

        // Determine tax rate
        $taxRate = $taxableIncome < 50000000 ? 0.25 : 0.30;

        // Calculate tax payable
        $taxPayable = $taxableIncome * $taxRate;

        // Determine entity type
        $entityType = $taxableIncome < 50000000 ? "Base Rate Entity" : "Full Rate Entity";

        // Return as associative array
        return [
            'revenue' => $revenue,
            'cost' => $cost,
            'taxableIncome' => $taxableIncome,
            'entityType' => $entityType,
            'taxRate' => ($taxRate * 100) . '%',
            'taxPayable' => $taxPayable,
        ];
    }
}
