<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeductionRequest;
use App\Model\Deduction;
use Illuminate\Support\Facades\Log;

class DeductionController extends Controller
{

    public function __construct()
    {
        $this->middleware('demo')->only(['store', 'update', 'destroy']);
    }

    public function index()
    {
        $results = Deduction::get();
        return view('admin.payroll.deduction.index', ['results' => $results]);
    }

    public function create()
    {
        return view('admin.payroll.deduction.form');
    }

    public function store(DeductionRequest $request)
    {
        $input = $request->all();
        try {
            Deduction::create($input);
            return ajaxResponse(200, 'Deduction Successfully saved.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ajaxResponse(500, 'Something Error Found !, Please try again.');
        }
    }

    public function edit($id)
    {
        $editModeData = Deduction::findOrFail($id);
        return view('admin.payroll.deduction.form', ['editModeData' => $editModeData]);
    }

    public function update(DeductionRequest $request, $id)
    {
        $data  = Deduction::FindOrFail($id);
        $input = $request->all();
        try {
            $data->update($input);
            return ajaxResponse(200, 'Deduction Successfully Updated.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ajaxResponse(500, 'Something Error Found !, Please try again.');
        }
    }

    public function destroy($id)
    {
        try {
            $data = Deduction::findOrFail($id);
            $data->delete();
            echo "success";
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->errorInfo[1] == 1451) {
                echo 'hasForeignKey';
            } else {
                echo 'error';
            }
        }
    }
}
