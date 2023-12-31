<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Model\Role;
use App\User;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('demo')->only(['update', 'store', 'destroy']);
    }

    public function index()
    {
        $data = Role::all();
        return view('admin.user.role.index', compact('data'));
    }

    public function create()
    {
        return view('admin.user.role.form');
    }

    public function store(RoleRequest $request)
    {
        $input = $request->all();
        try {
            Role::create($input);
            return ajaxResponse(200, 'Role Successfully saved.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ajaxResponse(500, 'Internal Server Error');
        }
    }

    public function edit($id)
    {
        $editModeData = Role::FindOrFail($id);
        return view('admin.user.role.form', compact('editModeData'));
    }

    public function update(RoleRequest $request, $id)
    {
        $data  = Role::FindOrFail($id);
        $input = $request->all();
        try {
            $data->update($input);
            return ajaxResponse(200, 'Role Successfully Updated.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ajaxResponse(500, 'Internal Server Error');
        }
    }

    public function destroy($id)
    {

        if ($id == 1) {

            return "You cannot delete super admin role";
        }
        $count = User::where('role_id', '=', $id)->count();

        if ($count > 0) {
            return "hasForeignKey";
        }

        if ($id == 1) {
            return "error";
        }
        try {
            $role = Role::FindOrFail($id);
            $role->delete();
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
