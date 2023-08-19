<?php
namespace App\Traits;

use App\Model\Employee;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

trait EmailSendTrait
{

    public function sendLeaveApplicationUpdateEmail($status, $application, $employee)
    {
        try
        {

            $subject = "Your Leave Application has been " . $status;
            if ($status == 'Approved') {
                $approver = Employee::find($application->approve_by);
            } else {
                $approver = Employee::find($application->reject_by);
            }

            $data['subject']   = $subject;
            $data['status']    = $status;
            $data['email']     = $employee->email;
            $data['name']      = $employee->first_name . ' ' . $employee->last_name;
            $data['date_from'] = $application->application_from_date;
            $data['date_to']   = $application->application_to_date;
            $data['by_user']   = $approver->first_name . ' ' . $approver->last_name;

            Mail::send('emails.leave_action', ['data' => $data], function ($message) use ($data) {
                $message->to($data["email"], $data["name"])->subject($data["subject"]);
            });

        } catch (Exception $e) {
            dd($e);
            Log::error("sending leave email " . $e->getMessage());
        }
    }
}
