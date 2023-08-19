<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\WarningRequest;
use App\Model\Warning;
use App\Repositories\CommonRepository;
use Illuminate\Support\Facades\Log;

class WarningController extends Controller
{

    protected $commonRepository;

    public function __construct(CommonRepository $commonRepository)
    {
        $this->commonRepository = $commonRepository;
    }

    public function index()
    {
        $results = Warning::with(['warningTo', 'warningBy'])->get();
        return view('admin.employee.warning.index', ['results' => $results]);
    }

    public function create()
    {
        $employeeList = $this->commonRepository->employeeList();
        return view('admin.employee.warning.form', ['employeeList' => $employeeList]);
    }

    public function store(WarningRequest $request)
    {
        $input                 = $request->all();
        $input['warning_date'] = dateConvertFormtoDB($request->warning_date);

        try {
            Warning::create($input);
            return ajaxResponse(200, 'Employee warning successfully saved.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ajaxResponse(500, 'Internal Server Error');
        }
    }

    public function edit($id)
    {
        $editModeData = Warning::findOrFail($id);
        $employeeList = $this->commonRepository->employeeList();
        return view('admin.employee.warning.form', ['employeeList' => $employeeList, 'editModeData' => $editModeData]);
    }

    public function show($id)
    {
        $results = Warning::with(['warningTo.department', 'warningBy'])->where('warning_id', $id)->first();
        return view('admin.employee.warning.details', ['result' => $results]);
    }

    public function update(WarningRequest $request, $id)
    {
        $data                  = Warning::findOrFail($id);
        $input                 = $request->all();
        $input['warning_date'] = dateConvertFormtoDB($request->warning_date);

        try {
            $data->update($input);
            return ajaxResponse(200, 'Employee warning successfully updated.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ajaxResponse(500, 'Internal Server Error');
        }
    }

    public function destroy($id)
    {
        try {
            $data = Warning::FindOrFail($id);
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
