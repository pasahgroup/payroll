<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use App\Http\Requests\BonusSettingRequest;
use App\Model\BonusSetting;
use Illuminate\Support\Facades\Log;

class BonusSettingController extends Controller
{

    public function __construct()
    {
        $this->middleware('demo')->only(['store', 'update', 'destroy']);
    }

    public function index()
    {
        $results = BonusSetting::get();
        return view('admin.payroll.bonusSetting.index', ['results' => $results]);
    }

    public function create()
    {
        return view('admin.payroll.bonusSetting.form');
    }

    public function store(BonusSettingRequest $request)
    {
        $input = $request->all();
        try {
            BonusSetting::create($input);
            return ajaxResponse(200, 'Bonus successfully saved.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ajaxResponse(500, 'Something Error Found !, Please try again.');
        }
    }

    public function edit($id)
    {
        $editModeData = BonusSetting::FindOrFail($id);
        return view('admin.payroll.bonusSetting.form', compact('editModeData'));
    }

    public function update(BonusSettingRequest $request, $id)
    {
        $data  = BonusSetting::FindOrFail($id);
        $input = $request->all();
        try {
            $data->update($input);
            return ajaxResponse(200, 'Bonus successfully updated.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ajaxResponse(500, 'Something Error Found !, Please try again.');
        }
    }

    public function destroy($id)
    {
        try {
            $data = BonusSetting::FindOrFail($id);
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
