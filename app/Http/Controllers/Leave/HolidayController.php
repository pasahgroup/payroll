<?php

namespace App\Http\Controllers\Leave;

use App\Http\Controllers\Controller;
use App\Http\Requests\HolidayRequest;
use App\Model\Holiday;
use Illuminate\Support\Facades\Log;

class HolidayController extends Controller
{

    public function __construct()
    {
        $this->middleware('demo')->only(['store', 'update', 'destroy']);
    }

    public function index()
    {
        $results = Holiday::orderBy('holiday_id', 'desc')->get();
        return view('admin.leave.holiday.index', ['results' => $results]);
    }

    public function create()
    {
        return view('admin.leave.holiday.form');
    }

    public function store(HolidayRequest $request)
    {
        $input = $request->all();
        try {
            Holiday::create($input);
            return ajaxResponse(200, 'Holiday Successfully saved.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ajaxResponse(500, 'Internal Server Error');
        }

    }

    public function edit($id)
    {
        $editModeData = Holiday::findOrFail($id);
        return view('admin.leave.holiday.form', ['editModeData' => $editModeData]);
    }

    public function update(HolidayRequest $request, $id)
    {
        $holiday = Holiday::findOrFail($id);
        $input   = $request->all();
        try {
            $holiday->update($input);
            return ajaxResponse(200, 'Holiday Successfully Updated.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ajaxResponse(500, 'Internal Server Error');
        }

    }

    public function destroy($id)
    {
        try {
            $holiday = Holiday::findOrFail($id);
            $holiday->delete();
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
