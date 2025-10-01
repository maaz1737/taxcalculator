<?php

namespace App\Services\Finance;

class MortgageService
{
    public function calculate(array $in): array
    {
        $price   = (float) $in['price'];
        $years   = (int)   $in['years'];
        $apr     = (float) $in['apr_percent'];


        // Down payment
        $down = 0.0;
        if (!empty($in['down_amount']))  $down = (float) $in['down_amount'];
        elseif (!empty($in['down_percent'])) $down = $price * ((float) $in['down_percent'] / 100);

        $loan = max(0.0, $price - $down);

        // Base amortization (P&I)
        $sched = Amortization::schedule($loan, $apr, $years, $in['start_date'] ?? null);
        $M = $sched['payment'];

        // Escrow pieces (monthly)
        $taxMonthly = isset($in['annual_property_tax'])   ? ((float)$in['annual_property_tax']   / 12.0) : 0.0;
        $insMonthly = isset($in['annual_home_insurance']) ? ((float)$in['annual_home_insurance'] / 12.0) : 0.0;
        $hoaMonthly = isset($in['hoa_monthly'])           ? (float)$in['hoa_monthly']            : 0.0;

        // PMI monthly: applies while LTV > 80% (balance > 0.80 * price)
        $pmiPct = isset($in['pmi_percent']) ? (float)$in['pmi_percent'] : 0.0;
        $pmiAnnual = $pmiPct > 0 ? $loan * ($pmiPct / 100) : 0.0;
        $pmiMonthlyFull = $pmiAnnual > 0 ? $pmiAnnual / 12.0 : 0.0;
        $ltvCutoff = 0.80 * $price;

        // enrich rows with PMI + totals per month
        $rowsOut = [];
        $pmiMonthlyCurrent = $pmiMonthlyFull;
        foreach ($sched['rows'] as $row) {
            if ($row['balance'] <= $ltvCutoff) {
                $pmiMonthlyCurrent = 0.0;
            }
            $totalMonthly = $M + $taxMonthly + $insMonthly + $pmiMonthlyCurrent + $hoaMonthly;
            $rowsOut[] = $row + [
                'pmi'          => round($pmiMonthlyCurrent, 2),
                'tax'          => round($taxMonthly, 2),
                'ins'          => round($insMonthly, 2),
                'hoa'          => round($hoaMonthly, 2),
                'total_monthly' => round($totalMonthly, 2),
            ];
        }

        return [
            'loan_amount'   => round($loan, 2),
            'monthly_PI'    => round($M, 2),
            'monthly_tax'   => round($taxMonthly, 2),
            'monthly_ins'   => round($insMonthly, 2),
            'monthly_hoa'   => round($hoaMonthly, 2),
            'monthly_pmi'   => round($pmiMonthlyFull, 2), // initial PMI (may drop later)
            'monthly_total' => round($M + $taxMonthly + $insMonthly + $pmiMonthlyFull + $hoaMonthly, 2),
            'total_interest' => $sched['total_interest'],
            'payoff_date'   => $sched['payoff_date'],
            'schedule'      => $rowsOut,
        ];
    }
}
