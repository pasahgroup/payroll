<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\DesignationRequest;
use App\Model\Designation;
use App\Model\Employee;
use Illuminate\Support\Facades\Log;

class DesignationController extends Controller
{

    public function __construct()
    {
        $this->middleware('demo')->only(['store', 'update', 'destroy']);
    }

    public function index()
    {
        $results = Designation::get();
        return view('admin.employee.designation.index', ['results' => $results]);
    }

    public function create()
    {
        return view('admin.employee.designation.form');
    }

    public function store(DesignationRequest $request)
    {
        $input = $request->all();
        try {
            Designation::create($input);
            return ajaxResponse(200, 'Designation Successfully saved.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ajaxResponse(500, 'Internal Server Error');
        }
    }

    public function edit($id)
    {
        $editModeData = Designation::findOrFail($id);
        return view('admin.employee.designation.form', ['editModeData' => $editModeData]);
    }

    public function update(DesignationRequest $request, $id)
    {
        $data  = Designation::findOrFail($id);
        $input = $request->all();
        try {
            $data->update($input);
            return ajaxResponse(200, 'Designation Successfully Updated.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ajaxResponse(500, 'Internal Server Error');
        }
    }

    public function destroy($id)
    {

        $count = Employee::where('designation_id', '=', $id)->count();

        if ($count > 0) {

            return 'hasForeignKey';
        }

        try {
            $department = Designation::FindOrFail($id);
            $department->delete();
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
