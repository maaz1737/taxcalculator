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
use App\Mail\FitnessCalculationResult;
use App\Services\Fitness\BmiService;
use App\Services\Fitness\BmrService;
use App\Services\Fitness\TdeeService;
use App\Services\Fitness\BodyFatService;
use App\Services\Fitness\IdealWeightService;
use App\Services\Fitness\MacrosService;

use App\Models\Calculation;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class FitnessController extends Controller
{

    public function bmi_view()
    {
        return view('fitness.bmi');
    }
    public function bmr_view()
    {
        return view('fitness.bmr');
    }
    public function tdee_view()
    {
        return view('fitness.tdee');
    }
    public function body_fat_view()
    {
        return view('fitness.bodyfat');
    }
    public function ideal_weight_view()
    {
        return view('fitness.idealweight');
    }
    public function macros_view()
    {
        return view('fitness.macros');
    }














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
        if (Auth::check()) {
            $v = $r->validated();


            $calc = Calculation::create([
                'user_id'   => Auth::id(),
                'calc_type' => $v['calc_type'],
                'inputs'    => $v['inputs'],
                'outputs'   => $v['outputs'],
            ]);

            Mail::to(Auth::user()->email)->send(new FitnessCalculationResult($calc));

            return response()->json([
                'ok' => true,
                'message' => 'Saved',
                'data' => ['id' => $calc->id]
            ]);
        } else {
            return response()->json([
                'ok' => false,
                'message' => 'Unauthorized User',

            ], 401);
        }
    }

    public function recent(Request $r): JsonResponse
    {

        $type = $r->string('type')->toString();

        $q = Calculation::query()
            ->when($type, fn($qq) => $qq->where('calc_type', $type))
            ->when($r->user(), fn($qq) => $qq->where('user_id', $r->user()->id))
            ->latest('id');

        // Default pagination (10 per page, or from query)
        $perPage = (int) $r->query('per_page', 10);

        $data = $q->paginate($perPage, ['id', 'calc_type', 'inputs', 'outputs', 'created_at']);

        return response()->json([
            'ok'   => true,
            'data' => $data
        ]);
    }
}
