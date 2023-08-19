<?php

namespace App\Http\Controllers;

use App\Model\Employee;
use App\ResetPassword;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{

    public function __construct()
    {
        $this->middleware('demo')->only(['sendResetLink']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.password_reset');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendResetLink(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try
        {

            $checkUser = Employee::where('email', $request->email)->first();
            if (!$checkUser) {
                return redirect()->back()->with('error', 'User not found with this email please provide valid email');
            }
            $random_string = str_random(60) . '_' . time();

            $user_id = $checkUser->user_id;
            $reset   = new ResetPassword;

            $reset->user_id     = $user_id;
            $reset->reset_token = $random_string;
            $reset->reset_code  = rand(1000, 9999);
            $reset->save();

            $data['token']   = $random_string;
            $data['name']    = $checkUser->first_name;
            $data['email']   = $checkUser->email;
            $data['subject'] = "Reset Password";

            Mail::send('emails.reset', ['data' => $data], function ($message) use ($data) {
                $message->to($data["email"], $data["name"])->subject($data["subject"]);
            });

            return redirect()->back()->with('success', 'We have sent you a reset password link please check your inbox');

        } catch (Exception $e) {

            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Check your mail email setting please');
        }
    }

    public function enterPassword(Request $request)
    {
        return view('auth.enter_password');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'token'    => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try
        {

            $userToken = ResetPassword::where('reset_token', $request->token)->first();

            if (!$userToken) {
                return redirect()->back()->with('error', 'Invalid Token');
            }

            $user           = User::find($userToken->user_id);
            $user->password = Hash::make($request->password);
            $user->update();

            $userToken->delete();

            return redirect('login')->with('success', 'Please login with your new password');

        } catch (Exception $e) {
            dd($e);
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

}
