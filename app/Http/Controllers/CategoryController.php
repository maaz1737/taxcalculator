<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FavoriteCalculators;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function TaxFinance()
    {

        $calculators =  FavoriteCalculators::where('user_id', Auth::id())->get();
        $calculatorNames = $calculators->pluck('name')->toArray();
        return view('finance_tax.finance_tax', compact('calculatorNames'));
    }
    public function MathMeasurement()
    {

        $calculators =  FavoriteCalculators::where('user_id', Auth::id())->get();
        $calculatorNames = $calculators->pluck('name')->toArray();


        return view('math_measurement.math_measurement', compact('calculatorNames'));
    }
    public function HealthFitness()
    {
        $calculators =  FavoriteCalculators::where('user_id', Auth::id())->get();
        $calculatorNames = $calculators->pluck('name')->toArray();
        return view('health_fitness.health_fitness', compact('calculatorNames'));
    }
}
