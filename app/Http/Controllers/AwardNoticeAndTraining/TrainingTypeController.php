<?php

namespace App\Http\Controllers\AwardNoticeAndTraining;

use App\Http\Controllers\Controller;
use App\Http\Requests\TrainingTypeRequest;
use App\Model\TrainingInfo;
use App\Model\TrainingType;
use Illuminate\Support\Facades\Log;

class TrainingTypeController extends Controller
{

    public function __construct()
    {
        $this->middleware('demo')->only(['store', 'update', 'destroy']);
    }

    public function index()
    {
        $results = TrainingType::orderBy('training_type_id', 'DESC')->get();
        return view('admin.training.trainingType.index', ['results' => $results]);
    }

    public function create()
    {
        return view('admin.training.trainingType.form');
    }

    public function store(TrainingTypeRequest $request)
    {
        $input = $request->all();

        try {
            TrainingType::create($input);
            return ajaxResponse(200, 'Training type successfully saved.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ajaxResponse(500, 'Internal Server Error');
        }
    }

    public function edit($id)
    {
        $editModeData = TrainingType::FindOrFail($id);
        return view('admin.training.trainingType.form', compact('editModeData'));
    }

    public function update(TrainingTypeRequest $request, $id)
    {
        $data  = TrainingType::FindOrFail($id);
        $input = $request->all();

        try {
            $data->update($input);
            return ajaxResponse(200, 'Training type successfully updated.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ajaxResponse(500, 'Internal Server Error');
        }
    }

    public function destroy($id)
    {
        try {
            $data = TrainingType::FindOrFail($id);
            $data->delete();
            TrainingInfo::where('training_type_id', '=', $id)->delete();
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
