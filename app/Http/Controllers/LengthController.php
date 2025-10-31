<?php

namespace App\Http\Controllers;

use App\Models\Length;
use Illuminate\Http\Request;
use App\Mail\CalculationResult;
use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class LengthController extends Controller
{


    public function index(Request $request): JsonResponse
    {
        $data = $request->validate([
            'category'  => 'nullable|string|max:50',
            'from'      => 'nullable|string|max:16',
            'to'        => 'nullable|string|max:16',
            'date_from' => 'nullable|date',
            'date_to'   => 'nullable|date',
            'q'         => 'nullable|string', // free text search in from/to
            'sort'      => ['nullable', Rule::in(['created_at', 'value', 'from_unit', 'to_unit'])],
            'order'     => ['nullable', Rule::in(['asc', 'desc'])],
            'per_page'  => 'nullable|integer|min:1|max:100',
        ]);

        $query = Length::query();

        // only fetch records belonging to logged-in user
        $query->where('user_id', Auth::id());

        if (!empty($data['category']))  $query->where('category', $data['category']);
        if (!empty($data['from']))      $query->where('from_unit', $data['from']);
        if (!empty($data['to']))        $query->where('to_unit', $data['to']);
        if (!empty($data['date_from'])) $query->whereDate('created_at', '>=', $data['date_from']);
        if (!empty($data['date_to']))   $query->whereDate('created_at', '<=', $data['date_to']);

        if (!empty($data['q'])) {
            $q = $data['q'];
            $query->where(function ($w) use ($q) {
                $w->where('from_unit', 'like', "%{$q}%")
                    ->orWhere('to_unit', 'like', "%{$q}%")
                    ->orWhere('category', 'like', "%{$q}%");
            });
        }

        $sort  = $data['sort']  ?? 'created_at';
        $order = $data['order'] ?? 'desc';

        $query->orderBy($sort, $order);

        $perPage = $data['per_page'] ?? 10;

        // only this user's paginated rows
        $rows = $query->paginate($perPage);


        return response()->json($rows);
    }



    public function store(Request $request)
    {


        $userId = Auth::id();

        $hasExpiredPayment = Payment::where('user_id', $userId)
            ->latest()
            ->first()?->end_date < Carbon::now();

        if ($hasExpiredPayment) {

            return response()->json([
                'message' => 'Pay to use extra benefits',
                'ok' => false
            ], 402);
        }


        if (Auth::user()) {

            $data = $request->validate([
                'category' => 'required|string|max:50',
                'from'     => 'required|string|max:16',
                'to'       => 'required|string|max:16',
                'value'    => 'required|numeric',
                'resultValue' => 'required',
            ]);

            $record = Length::create([
                'category' => $data['category'],
                'from_unit' => $data['from'],
                'user_id' => Auth::id(),
                'to_unit'  => $data['to'],
                'value'    => $data['value'],
                'result'    => $data['resultValue'],

            ]);

            Mail::to(Auth::user()->email)->send(new CalculationResult($record));


            return response()->json([
                'ok' => true,
                'id' => $record->id,
                'message' => 'Conversion saved successfully.',
            ], 200);
        } else {
            return response()->json([
                'ok' => false,
                'message' => 'Unauthenticated user.',
            ], 401);
        }
    }
}
