<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Http\Requests\Fitness\BmiRequest;
use App\Http\Requests\Fitness\BmrRequest;
use App\Http\Requests\Fitness\TdeeRequest;
use App\Http\Requests\Fitness\BodyFatRequest;
use App\Http\Requests\Fitness\IdealRequest;
use App\Http\Requests\Fitness\MacrosRequest;
use App\Http\Requests\Fitness\SaveCalcRequest;

use App\Services\Fitness\BmiService;
use App\Services\Fitness\BmrService;
use App\Services\Fitness\TdeeService;
use App\Services\Fitness\BodyFatService;
use App\Services\Fitness\IdealWeightService;
use App\Services\Fitness\MacrosService;

use App\Models\Calculation;
use Illuminate\Support\Facades\Auth;

class FitnessController extends Controller
{
    // --- calculators ---

    public function bmi(BmiRequest $r, BmiService $svc): JsonResponse
    {
        $inputs = $r->validated();
        $data = $svc->calculate($inputs);

        return response()->json(['ok' => true, 'inputs' => $inputs, 'data' => $data]);
    }

    public function bmr(BmrRequest $r, BmrService $svc): JsonResponse
    {
        $inputs = $r->validated();
        $data = $svc->calculate($inputs);

        return response()->json(['ok' => true, 'inputs' => $inputs, 'data' => $data]);
    }

    public function tdee(TdeeRequest $r, TdeeService $svc): JsonResponse
    {
        $inputs = $r->validated();
        $data = $svc->calculate($inputs);

        return response()->json(['ok' => true, 'inputs' => $inputs, 'data' => $data]);
    }

    public function bodyFat(BodyFatRequest $r, BodyFatService $svc): JsonResponse
    {
        $inputs = $r->validated();
        $data = $svc->calculate($inputs);

        return response()->json(['ok' => true, 'inputs' => $inputs, 'data' => $data]);
    }

    public function ideal(IdealRequest $r, IdealWeightService $svc): JsonResponse
    {
        $inputs = $r->validated();
        $data = $svc->calculate($inputs);

        return response()->json(['ok' => true, 'inputs' => $inputs, 'data' => $data]);
    }

    public function macros(MacrosRequest $r, MacrosService $svc): JsonResponse
    {
        $inputs = $r->validated();
        $data = $svc->calculate($inputs);

        return response()->json(['ok' => true, 'inputs' => $inputs, 'data' => $data]);
    }

    // ---------------- persistence -----------------------

    public function save(SaveCalcRequest $r): JsonResponse
    {
        $v = $r->validated();


        $calc = Calculation::create([
            'user_id'   => Auth::id(),
            'calc_type' => $v['calc_type'],
            'inputs'    => $v['inputs'],
            'outputs'   => $v['outputs'],
        ]);

        return response()->json([
            'ok' => true,
            'message' => 'Saved',
            'data' => ['id' => $calc->id]
        ]);
    }

    public function recent(Request $r): JsonResponse
    {
        $type  = $r->string('type')->toString();
        $limit = (int) ($r->query('limit', 10));

        $q = Calculation::query()
            ->when($type, fn($qq) => $qq->where('calc_type', $type))
            ->when($r->user(), fn($qq) => $qq->where('user_id', $r->user()->id))
            ->latest('id')
            ->limit($limit);

        return response()->json([
            'ok'   => true,
            'data' => $q->get(['id', 'calc_type', 'inputs', 'outputs', 'created_at'])
        ]);
    }
}
