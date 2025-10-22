<?php

namespace App\Http\Controllers;

use App\Models\FavoriteCalculators;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteCalculatorsController extends Controller
{
    public function index()
    {

        $calculators =  FavoriteCalculators::where('user_id', Auth::id())->get();


        return view('favorite.index', compact('calculators'));
    }
    public function store(Request $request)
    {
        $validate = $request->validate([
            'id' => 'required|string',
            'name' => 'required',
            'text' => 'nullable'
        ]);

        if (!Auth::check()) {
            return response()->json([
                'ok' => false,
                'message' => 'Unauthorized user',
            ], 401);
        }

        $userId = Auth::id();
        $favorite = FavoriteCalculators::where('user_id', $userId)
            ->where('name', $validate['id'])
            ->first();

        if ($favorite) {
            // ❌ Already exists — delete it (unfavorite)
            $favorite->delete();

            return response()->json([
                'ok' => true,
                'message' => "{$validate['name']} has been removed from favorites",
                'favorited' => false,
            ], 200);
        } else {
            // ✅ Does not exist — create it (favorite)
            FavoriteCalculators::create([
                'name' => $validate['id'],
                'user_id' => $userId,
                'title' => $validate['name'],
                'text' => $validate['text'],
            ]);

            return response()->json([
                'ok' => true,
                'message' => "{$validate['name']} has been added to favorites",
                'favorited' => true,
            ], 200);
        }
    }
}
