<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\TerminationRequest;
use App\Model\Employee;
use App\Model\Termination;
use App\Repositories\CommonRepository;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TerminationController extends Controller
{

    protected $commonRepository;

    public function __construct(CommonRepository $commonRepository)
    {
        $this->commonRepository = $commonRepository;
        $this->middleware('demo')->only(['store', 'update']);
    }

    public function index()
    {
        $results = Termination::with(['terminateTo', 'terminateBy'])->orderBy('termination_id', 'DESC')->get();
        return view('admin.employee.termination.index', ['results' => $results]);
    }

    public function create()
    {
        $employeeList = $this->commonRepository->employeeList();
        return view('admin.employee.termination.form', ['employeeList' => $employeeList]);
    }

    public function store(TerminationRequest $request)
    {
        $input                     = $request->all();
        $input['notice_date']      = dateConvertFormtoDB($request->notice_date);
        $input['termination_date'] = dateConvertFormtoDB($request->termination_date);

        try {
            $result = Termination::create($input);
            return ajaxResponse(200, 'Employee termination successfully saved.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ajaxResponse(500, 'Internal Server Error');
        }
    }

    public function edit($id)
    {
        $editModeData = Termination::findOrFail($id);
        $employeeList = $this->commonRepository->employeeList();
        return view('admin.employee.termination.form', ['employeeList' => $employeeList, 'editModeData' => $editModeData]);
    }

    public function show($id)
    {
        $results = Termination::with(['terminateTo.department', 'terminateBy'])->where('termination_id', $id)->first();
        return view('admin.employee.termination.details', ['result' => $results]);
    }

    public function update(TerminationRequest $request, $id)
    {
        $data                      = Termination::findOrFail($id);
        $input                     = $request->all();
        $input['notice_date']      = dateConvertFormtoDB($request->notice_date);
        $input['termination_date'] = dateConvertFormtoDB($request->termination_date);

        if (isset($request->submit)) {
            $input['status'] = 2;
        }

        try {
            DB::beginTransaction();

            $data->update($input);
            if (isset($request->submit)) {
                $employee = Employee::where('employee_id', $request->terminate_to)->first();
                $employee->where('employee_id', $request->terminate_to)->update(['status' => 3]);
                User::where('user_id', $employee->user_id)->update(['status' => 3]);
            }

            DB::commit();
            return ajaxResponse(200, 'Employee termination successfully updated.');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return ajaxResponse(500, 'Internal Server Error');
        }

        // if ($bug == 0) {
        //     if (isset($request->submit)) {
        //         return redirect('termination')->with('success', 'Employee termination successfully updated.');
        //     } else {
        //         return redirect()->back()->with('success', 'Employee termination successfully updated.');
        //     }
        // } else {
        //     return redirect()->back()->with('error', 'Something Error Found !, Please try again.');
        // }
    }

    public function destroy($id)
    {
        try {
            $data = Termination::FindOrFail($id);
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
