<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use App\Model\TaxRule;
use Illuminate\Http\Request;

class TaxSetupController extends Controller
{

    public function __construct()
    {
        $this->middleware('demo')->only(['updateTaxRule']);
    }

    public function index()
    {
        $maleTax   = TaxRule::where('gender', 'Male')->get();
        $femaleTax = TaxRule::where('gender', 'Female')->get();
        return view('admin.payroll.setup.taxSetup', ['maleTax' => $maleTax, 'femaleTax' => $femaleTax]);
    }

    public function updateTaxRule(Request $request)
    {
        $input = $request->all();
        $data  = TaxRule::findOrFail($request->tax_rule_id);

        try {
            $data->amount            = $request->amount;
            $data->percentage_of_tax = $request->percentage_of_tax;
            $data->amount_of_tax     = $request->amount_of_tax;
            $data->gender            = $request->gender;
            $data->update();
            $bug = 0;
        } catch (\Exception$e) {
            $bug = $e->errorInfo[1];
        }

        if ($bug == 0) {
            return "success";
        } else {
            return "error";
        }
    }
}
