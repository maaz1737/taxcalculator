<?php

namespace App\Http\Controllers;

use App\Models\SimpleCalculator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SimpleCalculatorController extends Controller
{


    public function index()
    {

        if (Auth::check()) {
            $results = SimpleCalculator::where('user_id', Auth::id())->latest()->get();

            return response()->json([
                'message' => 'history',
                'data' => $results
            ]);
        }
    }



    public function store(Request $req)
    {

        if (Auth::check()) {
            SimpleCalculator::create([
                'expr' => $req->expr,
                'result' => $req->result,
                'user_id' => Auth::id()
            ]);

            return response()->json([
                'message' => 'your record has been created.',
                'ok' => true
            ], 200);
        } else {
            return response()->json([
                'message' => 'Login to save results for later use.',
                'ok' => false
            ], 401);
        }
    }

    public function destory()
    {

        $records = SimpleCalculator::where('user_id', Auth::id())->get();

        foreach ($records as $record) {
            $record->delete();
        }

        return response()->json([
            'message' => 'History has been deleted.'
        ]);
    }
}
