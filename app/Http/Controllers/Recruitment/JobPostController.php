<?php

namespace App\Http\Controllers\Recruitment;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobPostRequest;
use App\Model\Job;
use Illuminate\Support\Facades\Auth;

class JobPostController extends Controller
{

    public function index()
    {
        $results = Job::with('createdBy')->orderBy('job_id', 'DESC')->paginate(10);
        return view('admin.recruitment.job.index', ['results' => $results]);
    }

    public function create()
    {
        return view('admin.recruitment.job.form');
    }

    public function store(JobPostRequest $request)
    {
        $input                         = $request->all();
        $input['created_by']           = Auth::user()->user_id;
        $input['updated_by']           = Auth::user()->user_id;
        $input['application_end_date'] = dateConvertFormtoDB($request->application_end_date);

        try {
            Job::create($input);
            return ajaxResponse(200, 'Job successfully created.');
        } catch (\Exception $e) {
            return ajaxResponse(500, 'Internal Server Error');
        }
    }

    public function edit($id)
    {
        $editModeData = Job::findOrFail($id);
        return view('admin.recruitment.job.form', ['editModeData' => $editModeData]);
    }

    public function show($id)
    {
        $results = Job::with(['createdBy'])->where('job_id', $id)->first();
        return view('admin.recruitment.job.details', ['result' => $results]);
    }

    public function update(JobPostRequest $request, $id)
    {
        $data                          = Job::findOrFail($id);
        $input                         = $request->all();
        $input['created_by']           = Auth::user()->user_id;
        $input['updated_by']           = Auth::user()->user_id;
        $input['application_end_date'] = dateConvertFormtoDB($request->application_end_date);

        try {
            $data->update($input);
            return ajaxResponse(200, 'Job successfully updated.');
        } catch (\Exception $e) {
            return ajaxResponse(500, 'Internal Server Error');
        }
    }

    public function destroy($id)
    {
        try {
            $data = Job::FindOrFail($id);
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
