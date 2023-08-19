<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use App\Http\Requests\WorkShiftRequest;
use App\Model\Employee;
use App\Model\WorkShift;
use Illuminate\Support\Facades\Log;

class WorkShiftController extends Controller
{

    public function __construct()
    {
        $this->middleware('demo')->only(['store', 'update', 'destroy']);
    }

    public function index()
    {
        $results = WorkShift::orderBy('work_shift_id', 'desc')->get();
        return view('admin.attendance.workShift.index', ['results' => $results]);
    }

    public function create()
    {
        return view('admin.attendance.workShift.form');
    }

    public function store(WorkShiftRequest $request)
    {
        $input                    = $request->all();
        $input['shift_name']      = $_POST['shift_name'];
        $input['start_time']      = date("H:i:s", strtotime($_POST['start_time']));
        $input['end_time']        = date("H:i:s", strtotime($_POST['end_time']));
        $input['late_count_time'] = date("H:i:s", strtotime($_POST['late_count_time']));
        try {
            WorkShift::create($input);
            return ajaxResponse(200, 'Work shift successfully saved.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ajaxResponse(500, 'Something Error Found !, Please try again.');
        }
    }

    public function edit($id)
    {
        $editModeData = WorkShift::findOrFail($id);
        return view('admin.attendance.workShift.form', ['editModeData' => $editModeData]);
    }

    public function update(WorkShiftRequest $request, $id)
    {
        $data                     = WorkShift::findOrFail($id);
        $input                    = $request->all();
        $input['shift_name']      = $_POST['shift_name'];
        $input['start_time']      = date("H:i:s", strtotime($_POST['start_time']));
        $input['end_time']        = date("H:i:s", strtotime($_POST['end_time']));
        $input['late_count_time'] = date("H:i:s", strtotime($_POST['late_count_time']));
        try {
            $data->update($input);
            return ajaxResponse(200, 'Work shift successfully updated.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ajaxResponse(500, 'Something Error Found !, Please try again.');
        }
    }

    public function destroy($id)
    {

        $count = Employee::where('work_shift_id', '=', $id)->count();

        if ($count > 0) {

            return "hasForeignKey";
        }

        try {
            $data = WorkShift::findOrFail($id);
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
