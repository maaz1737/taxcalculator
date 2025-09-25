<?php

namespace App\Services\Finance;

class IncomeTaxService
{
    function calculateIncomeTaxResident($income)
    {
        $tax = 0;

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

        return $tax;
    }

    function calculateMedicareLevy($income, $levyPercent)
    {
        if (!$levyPercent ) return 0;
        return $income * ($levyPercent / 100);
    }
}
