<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DayCounterController extends Controller
{
    public function index()
    {
        return view('dayCounter.day-counter');
    }
    public function calculate(Request $request)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $includeLast = $request->boolean('includeLast'); // true or false



        try {
            $start = new \DateTime($startDate);
            $end = new \DateTime($endDate);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid date format. Please use YYYY-MM-DD.'], 400);
        }

        if ($start > $end) {
            return response()->json(['error' => 'Start date must be before end date.'], 400);
        }

        // Clone end date to avoid modifying original
        $endCalc = clone $end;

        // Apply inclusion/exclusion of last day
        if ($includeLast) {
            $endCalc->modify('+1 day');   // include last day
        }

        // Calculate difference
        $interval = $start->diff($endCalc);


        $days    = $interval->days;
        $weeks   = floor($days / 7);
        $hours   = $days * 24;
        $minutes = $hours * 60;
        $seconds = $minutes * 60;

        // Get the day name of start date
        $startDayName = $start->format('l');  // Monday, Tuesday, Wednesday...

        // Build array of all dates
        $allDates = [];
        $period = new \DatePeriod(
            $start,
            new \DateInterval('P1D'),
            $includeLast ? (clone $end)->modify('+1 day') : (clone $end)->modify('+1 day')
        );

        foreach ($period as $date) {
            $allDates[] = $date->format('Y-m-d');
        }

        return response()->json([
            'days'       => $days,
            'weeks'      => $weeks,
            'hours'      => $hours,
            'minutes'    => $minutes,
            'seconds'    => $seconds,
            'start_day'  => $startDayName,
            'all_dates'  => $allDates,
            'last_day_include' => $includeLast
        ]);
    }
}
