<?php

namespace App\Services\Finance;

class DepreciationService
{
    /**
     * Build a yearly depreciation schedule.
     * Inputs: cost, salvage_value, life_years, method: 'straight_line'|'double_declining'|'sum_of_years_digits'
     * Options: ddb_switch_to_sl (bool), round (int, decimals)
     */
    public function schedule(array $in): array
    {


        $cost    = (float) $in['cost'];
        $salvage = (float) $in['salvage_value'];
        $life    = (int)   $in['life_years'];
        $method  = $in['method'];
        $round   = (int)   $in['round'];
        $switchToSL = (bool)($in['ddb_switch_to_sl'] ?? true);

        $base = max(0.0, $cost - $salvage);
        if ($base <= 0) {
            return [
                'inputs' => $in,
                'method_used' => $method,
                'totals' => ['depr_sum' => 0.0, 'end_book_value' => round($cost, $round)],
                'schedule' => [],
            ];
        }

        $rows = [];
        $accum = 0.0;
        $book  = $cost;
        $depr_sum = 0.0;

        switch ($method) {
            case 'straight_line':
                $annual = $base / $life;
                for ($y = 1; $y <= $life; $y++) {
                    // Last year fix-up to hit salvage exactly
                    $dep = ($y < $life) ? $annual : ($base - $accum);
                    $dep = round($dep, $round);
                    $accum += $dep;
                    $book = round($cost - $accum, $round);
                    $rows[] = ['year' => $y, 'depreciation' => $dep, 'accumulated' => round($accum, $round), 'book_value' => $book];
                    $depr_sum += $dep;
                }
                break;

            case 'double_declining':
                $rate = 2.0 / $life;         // DDB rate
                $switched = false;
                for ($y = 1; $y <= $life; $y++) {
                    $remainingYears = $life - $y + 1;
                    $ddb = $book * $rate;    // DDB amount before clamps
                    // Optionally switch to SL when SL on remaining is higher
                    if ($switchToSL && !$switched) {
                        $slRem = ($book - $salvage) / $remainingYears;
                        if ($slRem > $ddb) {
                            $ddb = $slRem;
                            $switched = true;
                        }
                    }
                    // Never depreciate below salvage
                    $ddb = min($ddb, $book - $salvage);
                    $dep = round($ddb, $round);

                    $accum += $dep;
                    $book  = round($book - $dep, $round);
                    $rows[] = [
                        'year' => $y,
                        'depreciation' => $dep,
                        'accumulated' => round($accum, $round),
                        'book_value' => $book,
                        'note' => ($switched ? 'SL mode' : 'DDB'),
                    ];
                    $depr_sum += $dep;
                }
                break;

            case 'sum_of_years_digits':
                $syd = $life * ($life + 1) / 2.0;
                for ($y = 1; $y <= $life; $y++) {
                    $remaining = $life - $y + 1;
                    $dep = $base * ($remaining / $syd);
                    // Last year fix-up
                    if ($y == $life) $dep = $base - $accum;
                    $dep = round($dep, $round);
                    $accum += $dep;
                    $book  = round($cost - $accum, $round);
                    $rows[] = ['year' => $y, 'depreciation' => $dep, 'accumulated' => round($accum, $round), 'book_value' => $book];
                    $depr_sum += $dep;
                }
                break;
        }




        return [
            'inputs'      => [
                'cost' => $cost,
                'salvage_value' => $salvage,
                'life_years' => $life,
                'method' => $method,
                'ddb_switch_to_sl' => $switchToSL,
                'round' => $round
            ],
            'method_used' => $method,
            'totals'      => [
                'depr_sum'       => round($depr_sum, $round),
                'end_book_value' => round($book, $round),
            ],
            'schedule'    => $rows,
        ];
    }
}
