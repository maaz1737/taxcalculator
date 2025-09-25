<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Finance\IncomeTaxRequest;
use App\Services\Finance\IncomeTaxService;
use Illuminate\Http\JsonResponse;

class IncomeTaxController extends Controller
{
    public function __construct(private IncomeTaxService $svc) {}

    public function __invoke(IncomeTaxRequest $request): JsonResponse
    {
        return response()->json($this->svc->calculate($request->validated()));
    }
}
