<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use App\Http\Requests\HourlyPayGradeRequest;
use App\Model\Employee;
use App\Model\HourlySalary;
use Illuminate\Support\Facades\Log;

class HourlyWagesPayrollController extends Controller
{

    public function index()
    {
        $results = HourlySalary::get();
        return view('admin.payroll.hourlyWagesSalary.index', ['results' => $results]);
    }

    public function create()
    {
        return view('admin.payroll.hourlyWagesSalary.form');
    }

    public function store(HourlyPayGradeRequest $request)
    {
        $input = $request->all();
        try {
            HourlySalary::create($input);
            return ajaxResponse(200, 'Hourly wages Pay grade successfully saved.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ajaxResponse(400, 'Something Error Found !, Please try again.');
        }

    }

    public function edit($id)
    {
        $editModeData = HourlySalary::FindOrFail($id);
        return view('admin.payroll.hourlyWagesSalary.form', compact('editModeData'));
    }

    public function update(HourlyPayGradeRequest $request, $id)
    {
        $data  = HourlySalary::FindOrFail($id);
        $input = $request->all();
        try {
            $data->update($input);
            return ajaxResponse(200, 'Hourly wages Pay grade successfully updated.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ajaxResponse(400, 'Something Error Found !, Please try again.');
        }
    }

    public function destroy($id)
    {

        $count = Employee::where('hourly_salaries_id', '=', $id)->count();

        if ($count > 0) {

            return "hasForeignKey";
        }

        try {
            $data = HourlySalary::FindOrFail($id);
            $data->delete();
            $bug = 0;
        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
        }

        if ($bug == 0) {
            echo "success";
        } elseif ($bug == 1451) {
            echo 'hasForeignKey';
        } else {
            echo 'error';
        }
    }

}
