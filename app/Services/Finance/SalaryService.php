<?php

namespace App\Services\Finance;

use App\Services\Finance\IncomeTaxService;

class SalaryService
{
    public function __construct(private IncomeTaxService $taxSvc) {}

    public function net(array $in)
    {
        $mode          = $in['mode'] ?? 'gross_to_net';
        $freq          = $in['pay_frequency'] ?? 'monthly';
        $amount        = (float)($in['amount'] ?? 0);
        $hoursPerWeek  = (float)($in['hours_per_week'] ?? 40);
        $weeksPerYear  = (float)($in['weeks_per_year'] ?? 52);
        $country       = strtoupper((string)($in['country_code'] ?? 'US'));
        $region        = (string)($in['region_code'] ?? '');
        $year          = (int)($in['tax_year'] ?? (int)date('Y'));
        $pretax        = (float)($in['pretax_deductions'] ?? 0);
        $posttax       = (float)($in['posttax_deductions'] ?? 0);
        $empIns        = (float)($in['employee_insurance'] ?? 0);
        $employerCosts = (float)($in['employer_costs'] ?? 0);
        $bonuses       = (float)($in['bonuses'] ?? 0);
        $allowances    = (float)($in['other_allowances'] ?? 0);
        $includeBreak  = (bool)($in['include_breakdown'] ?? true);
        $levy = $in['levy'];

        $annualGrossInput = $this->toAnnual($amount, $freq, $hoursPerWeek, $weeksPerYear);

        $tax = $this->taxSvc->calculateIncomeTaxResident($annualGrossInput);

        $medicare_levy = $this->taxSvc->calculateMedicareLevy($annualGrossInput, $levy);

        $income_after_tax =  $annualGrossInput - $tax - $medicare_levy;

        $monthly = $this->fromAnnual($income_after_tax,  'monthly', $hoursPerWeek,  $weeksPerYear);
        $weekly = $this->fromAnnual($income_after_tax, 'weekly', $hoursPerWeek,  $weeksPerYear);
        $biweekly      = $this->fromAnnual($income_after_tax, 'biweekly',  $hoursPerWeek, $weeksPerYear);
        $semimonthly      = $this->fromAnnual($income_after_tax, 'semimonthly',  $hoursPerWeek,  $weeksPerYear);
        $hourly      = $this->fromAnnual($income_after_tax, 'hourly',  $hoursPerWeek,  $weeksPerYear);


        return response()->json([
            'message' => 'calculation have been done',
            'data' => [
                'annual_amount' => $annualGrossInput,
                'tax' => $tax,
                'hourly' => $hourly,
                'weekly' => $weekly,
                'biweekly' => $biweekly,
                'semimonthly' => $semimonthly,
                'monthly' => $monthly,
                'after_tax' => $income_after_tax,
                'levy' => $levy,
                'medicare_levy' => $medicare_levy
            ]
        ]);
    }

    // ---------- helpers ----------

    private function toAnnual(float $amount, string $freq, float $hpw, float $wpy): float
    {
        return match ($freq) {
            'hourly'       => $amount * $hpw * $wpy,
            'weekly'       => $amount * $wpy,
            'biweekly'     => $amount * ($wpy / 2),
            'semimonthly'  => $amount * 24,
            'monthly'      => $amount * 12,
            'annual'       => $amount,
            default        => $amount,
        };
    }

    private function fromAnnual(float $annual, string $freq, float $hpw, float $wpy): float
    {
        return match ($freq) {
            'hourly'       => $wpy > 0 && $hpw > 0 ? $annual / ($hpw * $wpy) : 0,
            'weekly'       => $wpy > 0 ? $annual / $wpy : 0,
            'biweekly'     => $wpy > 0 ? $annual / ($wpy / 2) : 0,
            'semimonthly'  => $annual / 24,
            'monthly'      => $annual / 12,
            'annual'       => $annual,
            default        => $annual,
        };
    }

    private function scalePretax(float $pretax, string $freq, float $hpw, float $wpy): float
    {
        // Interpret pretax as amount per selected frequency and scale to annual
        return $this->toAnnual($pretax, $freq, $hpw, $wpy);
    }

    private function scalePosttax(float $posttax, string $freq, float $hpw, float $wpy): float
    {
        return $this->toAnnual($posttax, $freq, $hpw, $wpy);
    }

    private function solveGrossFromTargetNet(
        float $targetAnnualNet,
        float $pretaxPerPeriod,
        float $posttaxPerPeriod,
        float $empInsPerPeriod,
        float $bonusesAnnual,
        float $allowancesAnnual,
        string $country,
        string $region,
        int $year
    ): float {
        // simple binary search on annual gross
        $low = 0.0;
        $high = max(1.0, $targetAnnualNet * 3); // generous upper bound
        for ($i = 0; $i < 40; $i++) {
            $mid = ($low + $high) / 2.0;

            // Assume monthly frequency for scaling pretax/posttax/insurance in reverse solve
            $annualPretax  = $pretaxPerPeriod * 12;
            $annualPosttax = $posttaxPerPeriod * 12;
            $annualEmpIns  = $empInsPerPeriod * 12;

            $taxable = max(0.0, $mid + $allowancesAnnual + $bonusesAnnual - $annualPretax);
            $tax = $this->taxSvc->calculateIncomeTaxResident($taxable);
            $annualTax = (float)($tax ?? 0);

            $net = $mid + $allowancesAnnual + $bonusesAnnual - $annualPretax - $annualTax - $annualPosttax - $annualEmpIns;

            if ($net >= $targetAnnualNet) {
                $high = $mid;
            } else {
                $low = $mid;
            }
        }
        return round(($low + $high) / 2.0, 2);
    }
}
