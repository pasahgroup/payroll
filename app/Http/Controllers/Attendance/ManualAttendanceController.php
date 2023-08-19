<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use App\Lib\Enumerations\UserStatus;
use App\Model\Department;
use App\Model\Employee;
use App\Model\EmployeeAttendance;
use App\Model\IpSetting;
use App\Model\WhiteListedIp;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

// use MaatWebsite\Excel\Facades\Excel;

class ManualAttendanceController extends Controller
{

    public function manualAttendance()
    {
        $departmentList = Department::get();
        return view('admin.attendance.manualAttendance.index', ['departmentList' => $departmentList]);
    }

    public function filterData(Request $request)
    {
        $data           = dateConvertFormtoDB($request->get('date'));
        $department     = $request->get('department_id');
        $departmentList = Department::get();

        $attendanceData = Employee::select('employee.finger_id', 'employee.department_id',
            DB::raw('CONCAT(COALESCE(employee.first_name,\'\'),\' \',COALESCE(employee.last_name,\'\')) as fullName'),

            DB::raw('(SELECT DATE_FORMAT(MIN(view_employee_in_out_data.in_time), \'%h:%i %p\')  FROM view_employee_in_out_data
                                                             WHERE view_employee_in_out_data.date = "' . $data . '" AND view_employee_in_out_data.finger_print_id = employee.finger_id ) AS inTime'),

            DB::raw('(SELECT DATE_FORMAT(MAX(view_employee_in_out_data.out_time), \'%h:%i %p\') FROM view_employee_in_out_data
                                                             WHERE view_employee_in_out_data.date =  "' . $data . '" AND view_employee_in_out_data.finger_print_id = employee.finger_id ) AS outTime'))
            ->where('employee.department_id', $department)
            ->where('employee.status', 1)
            ->get();

        return view('admin.attendance.manualAttendance.index', ['departmentList' => $departmentList, 'attendanceData' => $attendanceData]);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $data       = dateConvertFormtoDB($request->get('date'));
            $department = $request->get('department_id');

            $result = json_decode(DB::table(DB::raw("(SELECT employee_attendance.*,employee.`department_id`,  DATE_FORMAT(`employee_attendance`.`in_out_time`,'%Y-%m-%d') AS `date` FROM `employee_attendance`
                    INNER JOIN `employee` ON `employee`.`finger_id` = employee_attendance.`finger_print_id`
                    WHERE department_id = $department) as employeeAttendance"))
                    ->select('employeeAttendance.employee_attendance_id')
                    ->where('employeeAttendance.date', $data)
                    ->get()->toJson(), true);

            DB::table('employee_attendance')->whereIn('employee_attendance_id', array_values($result))->delete();

            foreach ($request->finger_print_id as $key => $finger_print_id) {
                if (isset($request->inTime[$key]) && isset($request->outTime[$key])) {
                    $in_time  = dateConvertFormtoDB($request->date) . ' ' . date("H:i:s", strtotime($request->inTime[$key]));
                    $out_time = dateConvertFormtoDB($request->date) . ' ' . date("H:i:s", strtotime($request->outTime[$key]));

                    // for night shift
                    // if ($in_time > $out_time) {
                    //     $in_time = date('Y-m-d H:i:s', strtotime($in_time . ' -1 day'));
                    // }
                    $InData = [
                        'finger_print_id' => $finger_print_id,
                        'in_out_time'     => $in_time,
                        'created_at'      => Carbon::now(),
                        'updated_at'      => Carbon::now(),
                    ];
                    EmployeeAttendance::insert($InData);

                    $outData = [
                        'finger_print_id' => $finger_print_id,
                        'in_out_time'     => $out_time,
                        'created_at'      => Carbon::now(),
                        'updated_at'      => Carbon::now(),
                    ];
                    EmployeeAttendance::insert($outData);
                } else if (isset($request->inTime[$key])) {
                    $InData = [
                        'finger_print_id' => $finger_print_id,
                        'in_out_time'     => dateConvertFormtoDB($request->date) . ' ' . date("H:i:s", strtotime($request->inTime[$key])),
                        'created_at'      => Carbon::now(),
                        'updated_at'      => Carbon::now(),
                    ];
                    EmployeeAttendance::insert($InData);
                }
            }
            DB::commit();
            $bug = 0;
        } catch (\Exception $e) {
            DB::rollback();
            $bug = $e->errorInfo[1];
        }

        if ($bug == 0) {
            return redirect('manualAttendance')->with('success', 'Attendance successfully saved.');
        } else {
            return redirect('manualAttendance')->with('error', 'Something Error Found !, Please try again.');
        }
    }

    // ip attendance

    public function ipAttendance(Request $request)
    {

        try {

            $finger_id       = $request->finger_id;
            $ip_check_status = $request->ip_check_status;
            $user_ip         = \Request::ip();

            if ($ip_check_status == 0) {
                $att                  = new EmployeeAttendance;
                $att->finger_print_id = $finger_id;
                $att->in_out_time     = date("Y-m-d H:i:s");
                $att->save();

                return redirect()->back()->with('success', 'Attendance updated.');
            } else {
                $check_white_listed = WhiteListedIp::where('white_listed_ip', '=', $user_ip)->count();

                if ($check_white_listed > 0) {

                    $att                  = new EmployeeAttendance;
                    $att->finger_print_id = $finger_id;
                    $att->in_out_time     = date("Y-m-d H:i:s");
                    $att->save();

                    return redirect()->back()->with('success', 'Attendance updated.');
                } else {
                    return redirect()->back()->with('error', 'Invalid Ip Address.');
                }

            }
        } catch (\Exception $e) {
            return $e;
        }

    }

    // get to attendance ip setting page

    public function setupDashboardAttendance()
    {
        $ip_setting      = IpSetting::orderBy('updated_at', 'desc')->first();
        $white_listed_ip = WhiteListedIp::all();

        return view('admin.attendance.setting.dashboard_attendance', [
            'ip_setting'      => $ip_setting,
            'white_listed_ip' => $white_listed_ip,
        ]);
    }

    // post new attendance

    public function postDashboardAttendance(Request $request)
    {

        try
        {

            DB::beginTransaction();

            $setting = IpSetting::orderBy('id', 'desc')->first();

            $setting->status    = $request->status;
            $setting->ip_status = $request->ip_status;
            $setting->update();

            if ($request->ip) {

                WhiteListedIp::orderBy('id', 'desc')->delete();
                foreach ($request->ip as $value) {

                    if ($value != '') {

                        $white_listed_ip = new WhiteListedIp;

                        $white_listed_ip->white_listed_ip = $value;

                        $white_listed_ip->save();
                    }

                }
            }

            DB::commit();

            // return redirect()->back()->with('success', 'Employee Attendance Setting Updated');

            return ajaxResponse(200, 'Employee Attendance Setting Updated');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return ajaxResponse(500, 'Internal Server Error');
        }

    }

    // csv attendancce

    public function goToCsv()
    {
        return view('admin.attendance.csv.csv');
    }

    public static function getCsv($columnNames, $rows, $fileName = 'file.csv')
    {
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=" . $fileName,
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0",
        ];
        $callback = function () use ($columnNames, $rows) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columnNames);
            foreach ($rows as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }

    public function downloadEmployeeCsv()
    {

        $employee = Employee::where('status', UserStatus::$ACTIVE)->get();

        $headers = ['Finger ID', 'Name', 'In Time', 'Out Time'];

        $data = [];

        foreach ($employee as $emp) {

            $data[] = [
                $emp->finger_id,
                $emp->first_name,
                '10:00',
                '18:00',
            ];
        }

        $fileName = 'employee.csv';
        $file     = fopen('php://output', 'w');

        fputcsv($file, $headers);

        foreach ($data as $row) {
            fputcsv($file, $row);
        }

        fclose($file);

        $headers = array(
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        );

        $response = \Response::make(file_get_contents('php://output'), 200, $headers);
        // unlink($fileName);

        return $response;

    }

    // create attandance from csv

    public function uploadCsvAttendance(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'csv_file' => 'required|mimes:csv,txt',
            'date'     => 'required',
        ], [
            'csv_file.required' => 'Please select a file to upload',
            'csv_file.mimes'    => 'Please upload a csv file',
        ]);

        if ($validator->fails()) {
            return ajaxResponse(422, 'Invalid Input', $validator->errors());
        }

        $file = $request->file('csv_file');

        // Open the file for reading
        $handle = fopen($file, 'r');

        // Initialize an array to hold the data
        $data = [];

        // Loop through the file line by line
        while (($row = fgetcsv($handle)) !== false) {
            $data[] = $row;
        }

        // Close the file handle
        fclose($handle);

        // Remove the header row
        $header               = array_shift($data);
        $check_employee_exist = Employee::where('status', '=', UserStatus::$ACTIVE)->get();
        // Loop through the data and insert into database

        try
        {

            $in_data  = [];
            $out_data = [];
            foreach ($data as $row) {
                $row = array_combine($header, $row);

                if ($row['Finger ID'] && $row['In Time'] && $row['Out Time']) {

                    $emp_exist = $check_employee_exist->where('finger_id', $row['Finger ID'])->first();

                    if ($emp_exist) {
                        if ($row['In Time']) {
                            $in_data[] = [
                                'finger_print_id' => trim($row['Finger ID']),
                                'in_out_time'     => dateConvertFormtoDB($request->date) . ' ' . $row['In Time'] . ':00',
                                'created_at'      => date('Y-m-d H:i:s'),
                                'updated_at'      => date('Y-m-d H:i:s'),
                            ];
                        }
                        if ($row['Out Time']) {
                            $out_data[] = [
                                'finger_print_id' => trim($row['Finger ID']),
                                'in_out_time'     => dateConvertFormtoDB($request->date) . ' ' . $row['Out Time'] . ':00',
                                'created_at'      => date('Y-m-d H:i:s'),
                                'updated_at'      => date('Y-m-d H:i:s'),
                            ];
                        }

                    } else {
                        continue;
                    }

                } else {
                    continue;
                }

            }
            DB::beginTransaction();
            if (count($in_data) > 0) {
                EmployeeAttendance::insert($in_data);
            }

            if (count($out_data) > 0) {
                EmployeeAttendance::insert($out_data);
            }
            DB::commit();

            // return redirect()->back()->with('success', 'Attendance uploaded successfully');

            return ajaxResponse(200, 'Attendance uploaded successfully');

        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            // return redirect()->back()->with('error', $e->getMessage());

        }

    }

}
