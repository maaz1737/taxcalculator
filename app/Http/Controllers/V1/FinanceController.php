<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Models\TaxCollection;
use Illuminate\Validation\Rule;
use App\Models\SalleryCalculation;
use App\Http\Controllers\Controller;
use App\Services\Finance\TaxService;
use Illuminate\Support\Facades\Auth;
use App\Services\Finance\LoanService;
use App\Services\Finance\RentService;
use App\Http\Requests\MortgageRequest;
use App\Http\Requests\IncomeTaxRequest;
use App\Http\Requests\RentRequest;
use App\Models\RentCalculation;
use App\Services\Finance\SalaryService;
use App\Services\Finance\AutoLoanService;
use App\Services\Finance\MortgageService;
use App\Services\Finance\IncomeTaxService;
use App\Services\Finance\DepreciationService;
use App\Services\Finance\RentAffordabilityService;

class FinanceController extends Controller
{
    public function mortgage(MortgageRequest $request, MortgageService $svc)
    {
        $payload = $request->validated();
        return response()->json($svc->calculate($payload));
    }

    // --- Stubs for now (you’ll fill these services in the same pattern) ---
    // public function auto(Request $r, AutoLoanService $svc)
    // {
    //     return response()->json($svc->calculate($r->all()));
    // }
    // public function loan(Request $r, LoanService $svc)
    // {
    //     return response()->json($svc->calculate($r->all()));
    // }
    public function rent(Request $r, RentAffordabilityService $svc)
    {
        return response()->json($svc->calculate($r->all()));
    }
    public function tax(IncomeTaxRequest $r, IncomeTaxService $svc)
    {


        if (Auth::check()) {

            $tax =  $svc->calculateIncomeTaxResident($r->income);

            $levy =  $svc->calculateMedicareLevy($r->income, $r->levy);

            $taxLevy = $tax +  $levy;

            $taxpaid = $r->taxpaid;

            $remaining = $r->income - $taxLevy;

            TaxCollection::create([
                'total_income' => $r['income'],
                'user_id' => Auth::id(),
                'levy' =>    $levy,
                'tax' => $tax,
                'taxpaid' => $taxpaid,
                'remaining_income' => $remaining
            ]);

            return response()->json([
                'message' => 'Your record is addded',
                'ok' => true,
                'data' => [
                    'tax' => $tax,
                    'levy' => $levy,
                    'taxLevy' => $taxLevy,
                    'remaining' => $remaining,
                    'taxpaid' => $taxpaid,

                ]
            ], 200);
        }
        return response()->json([
            'message' => 'please login first',
            'ok' => false,
        ], 401);
    }


    public function getTax(Request $r)
    {

        if (Auth::check()) {
            $all =  TaxCollection::where('user_id', Auth::id())->latest()->paginate($r->perpage);

            return response()->json([
                'data' => $all,
                'ok' => true
            ], 200);
        } else {

            return response()->json([
                'message' => "please login first"
            ], 401);
        }
    }


    public function depreciation(Request $r, DepreciationService $svc)
    {
        return response()->json($svc->schedule($r->all()));
    }
    public function salary(Request $r, SalaryService $svc)
    {
        return response()->json($svc->net($r->all()));
    }

    public function save_salary(Request $request, SalaryService $svc)
    {

        if (Auth::check()) {
            $request->validate([
                'annual_amount' => ['required', 'numeric', 'min:2'],
                'after_tax'     => ['required', 'numeric'],
                'weekly'        => ['required', 'numeric'],
            ]);


            $in = $request->all();


            SalleryCalculation::create([
                'annual_amount' => round($in['annual_amount'], 2),
                'after_tax' =>  round($in['after_tax'], 2),
                'user_id' => Auth::id(),
                'hourly' =>  round($in['hourly'], 2),
                'weekly' =>  round($in['weekly'], 2),
                'biweekly' =>  round($in['biweekly'], 2),
                'monthly' =>  round($in['monthly'], 2),
                'semimonthly' =>  round($in['semimonthly'], 2),
                'medicare_levy' =>  round($in['medicare_levy'], 2),
                'tax' =>  round($in['tax'], 2),

            ]);

            return response()->json([
                'message' => 'your data inserted successfully',
                'ok' => true,
                'data' => $in,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Unauthenticated',
                'ok' => false
            ], 401);
        }
    }

    function salaryhistory(Request $request)
    {

        $salleryHistory = SalleryCalculation::where('user_id', Auth::id())->orderBy('id', 'desc')->paginate($request->per_page);;


        return response()->json([
            'message' => 'History',
            'data' => $salleryHistory
        ]);
    }

    function rent_save(RentRequest $request)
    {


        $reques = $request->all();
        $req = $request->validated();

        $monthlyIncome = data_get($req, 'inputs_echo.monthly_income');
        $input =  $reques['inputs_echo'];
        $housing = $reques['housing_costs'];


        if (Auth::check()) {

            RentCalculation::create([
                'monthly_income' => $input['monthly_income'],
                'user_id' => Auth::id(),
                'monthly_debts' => $input['monthly_debts'],
                'rule' => $input['custom_percent'] ?? $input['rule'],
                'utilities_monthly' => $housing['utilities'],
                'insurance_monthly' => $housing['insurance'],
                'rent' => $housing['rent'],
                'target_savings' => $input['saving_target'],
            ]);



            return response()->json([
                'message' => 'Data inserted successfully.',
                'data' => $reques,
                'ok' => true
            ], 200);
        } else {
            return response()->json([
                'message' => 'Unauthenticated.',
                'ok' => false
            ], 401);
        }
    }
    public function rentHistory()
    {


        $per_page = 4;
        $data = RentCalculation::where('user_id', Auth::id())->latest()->paginate($per_page);


        return response()->json([
            'message' => 'History',
            'data' => $data,
            'ok' => true
        ], 200);
    }
}
