<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use App\Http\Requests\AllowanceRequest;
use App\Model\Allowance;
use Illuminate\Support\Facades\Log;

class AllowanceController extends Controller
{

    public function __construct()
    {
        $this->middleware('demo')->only(['store', 'update', 'destroy']);
    }

    public function index()
    {
        $results = Allowance::get();
        return view('admin.payroll.allowance.index', ['results' => $results]);
    }

    public function create()
    {
        return view('admin.payroll.allowance.form');
    }

    public function store(AllowanceRequest $request)
    {
        $input = $request->all();
        try {
            Allowance::create($input);
            return ajaxResponse(200, 'Allowance Successfully saved.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ajaxResponse(400, 'Something Error Found !, Please try again.');
        }
    }

    public function edit($id)
    {
        $editModeData = Allowance::FindOrFail($id);
        return view('admin.payroll.allowance.form', compact('editModeData'));
    }

    public function update(AllowanceRequest $request, $id)
    {
        $data  = Allowance::FindOrFail($id);
        $input = $request->all();
        try {
            $data->update($input);
            return ajaxResponse(200, 'Allowance Successfully Updated.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ajaxResponse(400, 'Something Error Found !, Please try again.');
        }
    }

    public function destroy($id)
    {
        try {
            $data = Allowance::FindOrFail($id);
            $data->delete();
            echo "success";
        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
            if ($bug == 1451) {
                echo "hasForeignKey";
            } else {
                echo 'error';
            }

        }
    }

}
