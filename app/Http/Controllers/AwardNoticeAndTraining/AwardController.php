<?php

namespace App\Http\Controllers\AwardNoticeAndTraining;

use App\Http\Controllers\Controller;
use App\Http\Requests\AwardRequest;
use App\Model\EmployeeAward;
use App\Repositories\CommonRepository;
use Illuminate\Support\Facades\Log;

class AwardController extends Controller
{

    protected $commonRepository;

    public function __construct(CommonRepository $commonRepository)
    {
        $this->commonRepository = $commonRepository;
    }

    public function index()
    {
        $results = EmployeeAward::with('employee')->orderBy('employee_award_id', 'DESC')->get();
        return view('admin.award.index', ['results' => $results]);
    }

    public function create()
    {
        $employeeList = $this->commonRepository->employeeList();
        return view('admin.award.form', ['employeeList' => $employeeList]);
    }

    public function store(AwardRequest $request)
    {
        $input = $request->all();
        try {
            EmployeeAward::create($input);
            return ajaxResponse(200, 'Award Successfully saved.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ajaxResponse(500, 'internal server error');

        }
    }

    public function edit($id)
    {
        $employeeList = $this->commonRepository->employeeList();
        $editModeData = EmployeeAward::FindOrFail($id);
        return view('admin.award.form', compact('editModeData', 'employeeList'));
    }

    public function update(AwardRequest $request, $id)
    {
        $data  = EmployeeAward::FindOrFail($id);
        $input = $request->all();
        try {
            $data->update($input);
            return ajaxResponse(200, 'Award Successfully Updated.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ajaxResponse(500, 'internal server error');
        }
    }

    public function destroy($id)
    {
        try {
            $data = EmployeeAward::FindOrFail($id);
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
