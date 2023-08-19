<?php

namespace App\Http\Controllers\Leave;

use App\Http\Controllers\Controller;
use App\Http\Requests\WeeklyHolidayRequest;
use App\Model\WeeklyHoliday;
use App\Repositories\CommonRepository;
use Illuminate\Support\Facades\Log;

class WeeklyHolidayController extends Controller
{

    protected $commonRepository;

    public function __construct(CommonRepository $commonRepository)
    {
        $this->commonRepository = $commonRepository;
        $this->middleware('demo')->only(['store', 'update', 'destroy']);
    }

    public function index()
    {
        $results = WeeklyHoliday::get();
        return view('admin.leave.weeklyHoliday.index', ['results' => $results]);
    }

    public function create()
    {
        $weekList = $this->commonRepository->weekList();
        return view('admin.leave.weeklyHoliday.form', ['weekList' => $weekList]);
    }

    public function store(WeeklyHolidayRequest $request)
    {
        $input = $request->all();
        try {
            WeeklyHoliday::create($input);
            return ajaxResponse(200, 'Weekly holiday successfully saved.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ajaxResponse(500, 'Internal Server Error');
        }
    }

    public function edit($id)
    {
        $weekList     = $this->commonRepository->weekList();
        $editModeData = WeeklyHoliday::findOrFail($id);
        return view('admin.leave.weeklyHoliday.form', ['editModeData' => $editModeData, 'weekList' => $weekList]);
    }

    public function update(WeeklyHolidayRequest $request, $id)
    {
        $input = $request->all();
        $data  = WeeklyHoliday::findOrFail($id);
        try {
            $data->update($input);
            return ajaxResponse(200, 'Weekly holiday successfully updated.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ajaxResponse(500, 'Internal Server Error');
        }

    }

    public function destroy($id)
    {
        try {
            $data = WeeklyHoliday::findOrFail($id);
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
