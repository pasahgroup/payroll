<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{

    public function __construct()
    {

        $this->middleware('demo')->only('update');

    }

    public function index()
    {
        return view('admin.user.user.changePassword');

    }

    public function update(ChangePasswordRequest $request, $id)
    {
        try {
            $input['password'] = Hash::make($request['password']);
            if (Auth::attempt(['user_id' => Auth::user()->user_id, 'password' => $request->oldPassword])) {
                User::where('user_id', Auth::user()->user_id)->update($input);
                return ajaxResponse(200, 'Password changed successfully.');
            } else {
                return ajaxResponse(400, 'Old password does not match.');
            }
        } catch (\Exception $e) {
            return ajaxResponse(400, $e->getMessage());
        }
    }

}
