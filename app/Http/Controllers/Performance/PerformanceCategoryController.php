<?php

namespace App\Http\Controllers\Performance;

use App\Http\Controllers\Controller;
use App\Http\Requests\PerformanceCategoryRequest;
use App\Model\PerformanceCategory;
use App\Model\PerformanceCriteria;
use Illuminate\Support\Facades\Log;

class PerformanceCategoryController extends Controller
{

    public function index()
    {
        $results = PerformanceCategory::all();
        return view('admin.performance.performanceCategory.index', ['results' => $results]);
    }

    public function create()
    {
        return view('admin.performance.performanceCategory.form');
    }

    public function store(PerformanceCategoryRequest $request)
    {
        $input = $request->all();
        try {
            PerformanceCategory::create($input);
            return ajaxResponse(200, 'Performance Category Successfully saved.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ajaxResponse(500, 'Internal Server Error');
        }
    }

    public function edit($id)
    {
        $editModeData = PerformanceCategory::FindOrFail($id);
        return view('admin.performance.performanceCategory.form', ['editModeData' => $editModeData]);
    }

    public function update(PerformanceCategoryRequest $request, $id)
    {
        $data  = PerformanceCategory::FindOrFail($id);
        $input = $request->all();
        try {
            $data->update($input);
            return ajaxResponse(200, 'Performance Category Successfully Updated.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ajaxResponse(500, 'Internal Server Error');
        }

    }

    public function destroy($id)
    {

        $count = PerformanceCriteria::where('performance_category_id', $id)->count();

        if ($count > 0) {
            echo 'hasForeignKey';
            exit();
        }

        try {
            PerformanceCategory::findOrFail($id)->delete();
            echo 'success';
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                echo 'hasForeignKey';
            } else {
                echo 'error';
            }
        }
    }

}
