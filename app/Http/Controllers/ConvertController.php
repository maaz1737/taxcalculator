<?php

namespace App\Http\Controllers;

use App\Services\ConversionService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ConvertController extends Controller
{
    public function convert(Request $req, ConversionService $svc)
    {
        $data = $req->validate([
            'category' => ['required', Rule::in(array_keys(config('units')))],
            'from'     => ['required', 'string'],
            'to'       => ['required', 'string'],
            'value'    => ['required', 'numeric'],
        ]);

        return response()->json([
            'result' => $svc->convert(
                $data['category'],
                $data['from'],
                $data['to'],
                (float)$data['value']
            ),
        ]);
    }

    public function table(Request $req, ConversionService $svc)
    {
        $data = $req->validate([
            'category' => ['required', Rule::in(array_keys(config('units')))],
            'from'     => ['required', 'string'],
            'value'    => ['required', 'numeric'],
        ]);


        return response()->json([
            'rows' => $svc->table($data['category'], $data['from'], (float)$data['value']),
        ]);
    }

}
