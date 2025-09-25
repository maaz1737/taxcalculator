<?php

namespace App\Http\Controllers\Api;

use App\Models\Length;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

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

        // Laravel paginator structure: { data, links, meta, ... }
        $rows = $query->paginate($perPage);

        return response()->json($rows);
    }



    public function store(Request $request): JsonResponse
    {



        $data = $request->validate([
            'category' => 'required|string|max:50',
            'from'     => 'required|string|max:16',
            'to'       => 'required|string|max:16',
            'value'    => 'required|numeric',
            'resultValue'=>'required',
        ]);

        $record = Length::create([
            'category' => $data['category'],
            'from_unit' => $data['from'],
            'to_unit'  => $data['to'],
            'value'    => $data['value'],
            'result'    => $data['resultValue'],

        ]);

        return response()->json([
            'ok' => true,
            'id' => $record->id,
            'message' => 'Conversion saved successfully.',
        ], 201);
    }
}
