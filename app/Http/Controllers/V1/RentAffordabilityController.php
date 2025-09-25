<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Finance\RentAffordabilityRequest;
use App\Services\Finance\RentAffordabilityService;
use Illuminate\Http\JsonResponse;

class RentAffordabilityController extends Controller
{
    public function __construct(private RentAffordabilityService $service) {

    }

    public function __invoke(RentAffordabilityRequest $request): JsonResponse
    {
        $result = $this->service->calculate($request->validated());
        return response()->json($result);
    }
}
