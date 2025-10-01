<?php

namespace App\Services\Finance;

use Carbon\Carbon;

class Amortization
{
    public static function pmt(float $principal, float $aprPercent, int $years, int $ppY = 12): float
    {
        $n = $years * $ppY;
        $r = ($aprPercent / 100) / $ppY;
        if ($r == 0.0) return $principal / $n;
        return $principal * $r / (1 - pow(1 + $r, -$n));
    }

    public static function schedule(
        float $principal,
        float $aprPercent,
        int $years,
        ?string $startDate = null,
        int $ppY = 12
    ): array {

        $n = $years * $ppY;
        $r = ($aprPercent / 100) / $ppY;
        $payment = self::pmt($principal, $aprPercent, $years, $ppY);

        $rows = [];
        $balance = $principal;
        $date = $startDate ? Carbon::parse($startDate) : Carbon::now();
        // assume first payment due next month
        $date = $date->copy()->addMonthsNoOverflow();

        for ($k = 1; $k <= $n; $k++) {
            $interest = $r > 0 ? $balance * $r : 0.0;
            $principalPaid = min($payment - $interest, $balance);
            $balance = max(0, $balance - $principalPaid);

            $rows[] = [
                'index'     => $k,
                'date'      => $date->toDateString(),
                'payment'   => round($payment, 2),
                'interest'  => round($interest, 2),
                'principal' => round($principalPaid, 2),
                'balance'   => round($balance, 2),
            ];

            $date = $date->addMonthsNoOverflow();
        }

        $totalInterest = array_sum(array_column($rows, 'interest'));

        return [
            'payment'        => round($payment, 2),
            'total_interest' => round($totalInterest, 2),
            'payoff_date'    => $rows[count($rows) - 1]['date'] ?? null,
            'rows'           => $rows,
        ];
    }
}
