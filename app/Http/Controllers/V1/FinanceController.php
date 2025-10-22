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
use App\Mail\DepreciationCalculationResult;
use App\Mail\MortgageCalculationResult;
use App\Mail\RentCalculationResult;
use App\Mail\SalaryCalculationResult;
use App\Mail\TaxCalculationResult;
use App\Models\Depreciation;
use App\Models\Mortgage;
use App\Models\RentCalculation;
use App\Services\Finance\SalaryService;
use App\Services\Finance\AutoLoanService;
use App\Services\Finance\MortgageService;
use App\Services\Finance\IncomeTaxService;
use App\Services\Finance\DepreciationService;
use App\Services\Finance\RentAffordabilityService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class FinanceController extends Controller
{
    public function mortgage(MortgageRequest $request, MortgageService $svc)
    {
        $payload = $request->validated();
        return response()->json($svc->calculate($payload));
    }

    public function mortgage_save(MortgageRequest $request)
    {

        if (Auth::check()) {
            $mortgageCreated =  Mortgage::create([
                "price" => $request->price,
                "down_amount" => $request->down_amount,
                "years" => $request->years,
                'user_id' => Auth::id(),
                "apr_percent" => $request->apr_percent,
                "annual_property_tax" => $request->annual_property_tax,
                "annual_home_insurance" => $request->annual_home_insurance,
                "pmi_percent" =>  $request->pmi_percent ?? 0,
                "hoa_monthly" =>  $request->hoa_monthly ?? 0,
                "start_date" =>  $request->start_date,
            ]);


            Mail::to(Auth::user()->email)->send(new MortgageCalculationResult($mortgageCreated));

            return response()->json([

                'message' => 'New record has been created',
                'ok' => true

            ], 200);
        } else {
            return response()->json([

                'message' => 'Unauthenticated user',
                'ok' => false

            ], 401);
        }
    }

    public function mortgageHistory(MortgageService $svc)
    {

        $authUserData = Mortgage::where('user_id', Auth::user()->id)->latest()->paginate(10);


        $rawdata = [];

        foreach ($authUserData as $data) {
            $majbori = [
                "price" => $data['price'],
                "down_amount" =>  $data['down_amount'],
                "apr_percent" =>  $data['apr_percent'],
                "years" => $data['years'],
                "annual_property_tax" =>  $data['annual_property_tax'],
                "annual_home_insurance" =>  $data['annual_home_insurance'],
                "pmi_percent" =>  $data['pmi_percent'],
                "hoa_monthly" =>  $data['hoa_monthly'],
                "start_date" =>  $data['start_date'],
            ];
            $rawdata[] = $svc->calculate($majbori);
        };

        return response()->json([

            'message' => 'History',
            'data' => $rawdata,
            'dataForPagination' => $authUserData,
            'ok' => true

        ]);
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

            if ($r['payerType'] == 'individual') {
                $tax = $svc->calculateIncomeTaxResident($r->income);
                $levy = $svc->calculateMedicareLevy($r->income, $r->levy);
                $taxLevy = $tax + $levy;
                $taxpaid = $r->taxpaid;
                $remaining = $r->income - $taxLevy;

                $taxcreated = TaxCollection::create([
                    'total_income' => $r['income'],
                    'user_id' => Auth::id(),
                    'levy' => $levy,
                    'tax' => $tax,
                    'taxpaid' => $taxpaid,
                    'remaining_income' => $remaining,
                    'payerType' => $r->payerType
                ]);

                Mail::to(Auth::user()->email)->send(new TaxCalculationResult($taxcreated));

                return response()->json([
                    'message' => 'Your record is added',
                    'ok' => true,
                    'data' => [
                        'tax' => $tax,
                        'levy' => $levy,
                        'taxLevy' => $taxLevy,
                        'remaining' => $remaining,
                        'taxpaid' => $taxpaid,
                    ]
                ], 200);
            } else {
                $companyTax = $svc->calculateIncomeTaxNonIndividual($r->yearly_revenue, $r->yearly_cost);
                $remaining = $companyTax['taxPayable'] - $r['taxpaid'];

                $taxcreated = TaxCollection::create([
                    'total_income' => $companyTax['revenue'],
                    'user_id' => Auth::id(),
                    'tax' => $companyTax['taxPayable'],
                    'taxpaid' => $r['taxpaid'],
                    'cost' => $r['yearly_cost'],
                    'remaining_income' => $remaining,
                    'payerType' => $r->payerType
                ]);

                Mail::to(Auth::user()->email)->send(new TaxCalculationResult($taxcreated));

                return response()->json([
                    'message' => 'Your record is added',
                    'ok' => true,
                    'data' => []
                ], 200);
            }
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


            $salarycreated = SalleryCalculation::create([
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

            Mail::to(Auth::user()->email)->send(new SalaryCalculationResult($salarycreated));

            return response()->json([
                'message' => 'your data inserted successfully',
                'ok' => true,
                'data' => $in,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Unauthenticated User',
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

            $rentcreated =  RentCalculation::create([
                'monthly_income' => $input['monthly_income'],
                'user_id' => Auth::id(),
                'monthly_debts' => $input['monthly_debts'],
                'rule' => $input['custom_percent'] ?? $input['rule'],
                'utilities_monthly' => $housing['utilities'],
                'insurance_monthly' => $housing['insurance'],
                'rent' => $housing['rent'],
                'target_savings' => $input['saving_target'],
            ]);

            Mail::to(Auth::user()->email)->send(new RentCalculationResult($rentcreated));

            return response()->json([
                'message' => 'Data inserted successfully.',
                'data' => $reques,
                'ok' => true
            ], 200);
        } else {
            return response()->json([
                'message' => 'Unauthenticated user.',
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

    public function depreciationSave(Request $request, DepreciationService $dep)
    {


        if (Auth::check()) {
            $depreciationcreated =  Depreciation::create([
                'cost' => $request['inputs']['cost'],
                'user_id' => Auth::user()->id,
                'salvage' => $request['inputs']['salvage_value'],
                'method' => $request['inputs']['method'],
                'years' => $request['inputs']['life_years'],
                'ddb_switch_to_sl' => $request['inputs']['ddb_switch_to_sl'],
                'round' => $request['inputs']['round']
            ]);


            $yearly =  $dep->schedule([
                "cost" => $depreciationcreated['cost'],
                "salvage_value" => $depreciationcreated['salvage'],
                "method" => $depreciationcreated['method'],
                "life_years" => $depreciationcreated['years'],
                "ddb_switch_to_sl" => $depreciationcreated['ddb_switch_to_sl'],
                "round" => $depreciationcreated['round'],
            ]);


            Mail::to(Auth::user()->email)->send(new DepreciationCalculationResult($depreciationcreated, $yearly));


            return response()->json([

                'message' => 'you data inserted successfully',
                'ok' => true

            ], 200);
        } else {
            return response()->json([

                'message' => 'Unauthenticated User',
                'ok' => false

            ], 401);
        }
    }


    public function DepreciationHistory(Request $request, DepreciationService $dep)
    {

        $per_page = 5;

        $rawdata = Depreciation::where('user_id', Auth::id())->latest()->paginate(5);





        $filteredData = [];
        foreach ($rawdata as $data) {
            $majbori = [
                "cost" => $data['cost'],
                "salvage_value" => $data['salvage'],
                "method" => $data['method'],
                "life_years" => $data['years'],
                "ddb_switch_to_sl" => $data['ddb_switch_to_sl'],
                "round" => $data['round'],
            ];
            $filteredData[] = $dep->schedule($majbori);
        }


        return response()->json([
            'message' => 'history',
            'data' => $filteredData,
            'rawdata' => $rawdata
        ], 200);
    }
}
