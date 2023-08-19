<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\BranchRequest;
use App\Model\Branch;
use App\Model\Employee;
use Illuminate\Support\Facades\Log;

class BranchController extends Controller
{

    public function __construct()
    {
        $this->middleware('demo')->only(['store', 'update', 'destroy']);
    }

    public function index()
    {
        $results = Branch::get();
        return view('admin.employee.branch.index', ['results' => $results]);
    }

    public function create()
    {
        return view('admin.employee.branch.form');
    }

    public function store(BranchRequest $request)
    {
        $input = $request->all();
        try {
            Branch::create($input);
            return ajaxResponse(200, 'Branch Successfully saved.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ajaxResponse(500, 'Internal Server Error');
        }
    }

    public function edit($id)
    {
        $editModeData = Branch::findOrFail($id);
        return view('admin.employee.branch.form', ['editModeData' => $editModeData]);
    }

    public function update(BranchRequest $request, $id)
    {
        $branch = Branch::findOrFail($id);
        $input  = $request->all();
        try {
            $branch->update($input);
            return ajaxResponse(200, 'Branch Successfully Updated.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ajaxResponse(500, 'Internal Server Error');
        }
    }

    public function destroy($id)
    {

        $count = Employee::where('branch_id', '=', $id)->count();

        if ($count > 0) {

            return 'hasForeignKey';
        }

        try {
            $branch = Branch::findOrFail($id);
            $branch->delete();
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
