<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class AgeController extends Controller
{
    public function calculate(Request $request)
    {
        $validated = $request->validate([
            'dob_day' => 'required|integer|min:1|max:31',
            'dob_month' => 'required|integer|min:1|max:12',
            'dob_year' => 'required|integer|min:1900|max:' . now()->year,
            'till_day' => 'nullable|integer|min:1|max:31',
            'till_month' => 'nullable|integer|min:1|max:12',
            'till_year' => 'nullable|integer|min:1900|max:' . now()->year,
        ]);

        $tillYear = $validated['till_year'] ?? now()->year;
        $tillMonth = $validated['till_month'] ?? now()->month;
        $tillDay = $validated['till_day'] ?? now()->day;

        $dob = Carbon::create($validated['dob_year'], $validated['dob_month'], $validated['dob_day']);
        $till = Carbon::create($tillYear, $tillMonth, $tillDay);

        if ($till->lt($dob)) {
            return back()->withErrors(['till_date' => "'Till date' must be after Date of Birth."]);
        }

        $years = $dob->diffInYears($till);
        $months = $dob->diffInMonths($till) % 12;
        $days = $dob->copy()->addYears($years)->addMonths($months)->diffInDays($till);

        return response()->json([
            'result' => [
                'years' => $years,
                'months' => $months,
                'days' => $days,
            ]
        ]);
    }
}
