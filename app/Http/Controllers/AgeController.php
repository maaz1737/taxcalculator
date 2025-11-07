<?php

namespace App\Http\Controllers;

use App\Http\Requests\AgeRequest;
use App\Models\Age;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
    public function save(Request $request)
    {
        $data = $request->all();

        Age::create([
            'years' => $data['years'],
            'months' => $data['months'],
            'days' => $data['days'],
            // Add other fields as necessary
        ]);

        return response()->json(['message' => 'Age calculation saved successfully.']);
    }
}
