<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Model\CompanyAddressSetting;
use App\Model\PrintHeadSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GeneralSettingController extends Controller
{

    public function __construct()
    {
        $this->middleware('demo')->only(['store', 'update', 'printHeadSettingsStore', 'printHeadSettingsUpdate']);
    }

    public function index()
    {
        $data          = CompanyAddressSetting::first();
        $printHeadData = PrintHeadSetting::first();
        return view('admin.setting.generalSetting', ['data' => $data, 'printHeadData' => $printHeadData]);
    }

    public function store(Request $request)
    {
        $validator = validator::make($request->all(), [
            'address' => 'required|max:2000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->all();
        try {
            CompanyAddressSetting::create($input);
            $bug = 0;
        } catch (\Exception$e) {
            $bug = $e->errorInfo[1];
        }

        if ($bug == 0) {
            return redirect('generalSettings')->with('success', 'Company Address Successfully saved.');
        } else {
            return redirect('generalSettings')->with('error', 'Something Error Found !, Please try again.');
        }
    }

    public function update(Request $request, $id)
    {
        $validator = validator::make($request->all(), [
            'address' => 'required|max:2000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data  = CompanyAddressSetting::FindOrFail($id);
        $input = $request->all();
        try {
            $data->update($input);
            $bug = 0;
        } catch (\Exception$e) {
            $bug = $e->errorInfo[1];
        }

        if ($bug == 0) {
            return redirect('generalSettings')->with('success', 'Company Address Successfully Updated.');
        } else {
            return redirect('generalSettings')->with('error', 'Something Error Found !, Please try again.');
        }
    }

    public function printHeadSettingsStore(Request $request)
    {
        $validator = validator::make($request->all(), [
            'description' => 'required|max:2000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->all();
        try {
            PrintHeadSetting::create($input);
            $bug = 0;
        } catch (\Exception$e) {
            $bug = $e->errorInfo[1];
        }

        if ($bug == 0) {
            return redirect('generalSettings')->with('success', 'Print Head Successfully saved.');
        } else {
            return redirect('generalSettings')->with('error', 'Something Error Found !, Please try again.');
        }
    }

    public function printHeadSettingsUpdate(Request $request, $id)
    {
        $validator = validator::make($request->all(), [
            'description' => 'required|max:2000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data  = PrintHeadSetting::FindOrFail($id);
        $input = $request->all();
        try {
            $data->update($input);
            $bug = 0;
        } catch (\Exception$e) {
            $bug = $e->errorInfo[1];
        }

        if ($bug == 0) {
            return redirect('generalSettings')->with('success', 'Print Head Successfully Updated.');
        } else {
            return redirect('generalSettings')->with('error', 'Something Error Found !, Please try again.');
        }
    }

}
