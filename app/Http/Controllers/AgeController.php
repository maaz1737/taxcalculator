<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Age;
use Illuminate\Http\Request;
use App\Http\Requests\AgeRequest;
use Illuminate\Support\Facades\Auth;

class AgeController extends Controller
{
    public function index()
    {
        return view('age.age_calculator');
    }
    public function calculate(AgeRequest $request)
    {
        $validated = $request->validated();

        $tillYear = $validated['till_year'] ?? now()->year;
        $tillMonth = $validated['till_month'] ?? now()->month;
        $tillDay = $validated['till_day'] ?? now()->day;

        $dob  = Carbon::create($validated['dob_year'], $validated['dob_month'], $validated['dob_day']);
        $till = Carbon::create($tillYear, $tillMonth, $tillDay)->endOfDay();

        if ($till->lt($dob)) {
            return back()->withErrors(['till_date' => "'Till date' must be after Date of Birth."]);
        }

        // Normal Y-M-D difference
        $diff = $dob->diff($till);

        // --- TOTAL MONTHS (exact months, then leftover days)
        $totalMonths = $dob->diffInMonths($till);

        // Date after adding exact months
        $afterMonths = $dob->copy()->addMonths($totalMonths);
        $remainingMonthDays = $afterMonths->diffInDays($till);

        // --- TOTAL WEEKS (exact weeks, then leftover days)
        $totalDays = $dob->diffInDays($till);
        $totalWeeks = intdiv($totalDays, 7);          // same as floor()
        $remainingWeekDays = $totalDays % 7;

        return response()->json([
            'result' => [
                'years' => $diff->y,
                'months' => $diff->m,
                'days' => $diff->d,

                'total_months' => $totalMonths,
                'months_remaining' => $remainingMonthDays,

                'total_weeks' => $totalWeeks,
                'weeks_remaining' => $remainingWeekDays,

                'total_days' => $totalDays,
                'total_hours' => $dob->diffInHours($till),
                'total_minutes' => $dob->diffInMinutes($till),
                'total_seconds' => $dob->diffInSeconds($till),
            ]
        ]);
    }



    public function save(Request $request)
    {
        $data = $request->all();


        Age::create([
            'years' => $data['years'],
            'months' => $data['months'],
            'days' => $data['days'],
            'user_id' => Auth::id(),
        ]);

        return response()->json(['message' => 'Age calculation saved successfully.']);
    }
    public function history()
    {
        $user = Auth::user();
        $ageCalculations = Age::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        return response()->json(['history' => $ageCalculations]);
    }
}
