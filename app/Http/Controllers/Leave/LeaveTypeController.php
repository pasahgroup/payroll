<?php

namespace App\Http\Controllers\Leave;

use App\Http\Controllers\Controller;
use App\Http\Requests\LeaveTypeRequest;
use App\Model\LeaveApplication;
use App\Model\LeaveType;
use Illuminate\Support\Facades\Log;

class LeaveTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('demo')->only(['store', 'update', 'destroy']);
    }

    public function index()
    {
        $results = LeaveType::OrderBy('leave_type_id', 'desc')->where('leave_type_id', '!=', 1)->get();
        return view('admin.leave.leaveType.index', ['results' => $results]);
    }

    public function create()
    {
        return view('admin.leave.leaveType.form');
    }

    public function store(LeaveTypeRequest $request)
    {
        $input = $request->all();
        try {
            LeaveType::create($input);
            return ajaxResponse(200, 'Leave Type Successfully saved.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ajaxResponse(500, 'Internal Server Error');
        }

    }

    public function edit($id)
    {
        $editModeData = LeaveType::findOrFail($id);
        return view('admin.leave.leaveType.form', ['editModeData' => $editModeData]);
    }

    public function update(LeaveTypeRequest $request, $id)
    {
        $data  = LeaveType::findOrFail($id);
        $input = $request->all();
        try {
            $data->update($input);
            return ajaxResponse(200, 'Leave Type Successfully Updated.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ajaxResponse(500, 'Internal Server Error');
        }

    }

    public function destroy($id)
    {

        $count = LeaveApplication::where('leave_type_id', '=', $id)->count();

        if ($count > 0) {
            return "hasForeignKey";
        }

        try {
            $data = LeaveType::findOrFail($id);
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
