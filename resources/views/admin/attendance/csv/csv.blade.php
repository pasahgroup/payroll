@extends('admin.master')
@section('content')
@section('title')
    @lang('attendance.employee_attendance')
@endsection
<style>
    .departmentName {
        position: relative;
    }

    #department_id-error {
        position: absolute;
        top: 66px;
        left: 0;
        width: 100%he;
        width: 100%;
        height: 100%;
    }
</style>
<script>
    jQuery(function() {
        $("#employeeAttendance").validate();
    });
</script>
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
            <ol class="breadcrumb">
                <li class="active breadcrumbColor"><a href="{{ url('dashboard') }}"><i class="fa fa-home"></i>
                        @lang('dashboard.dashboard')</a></li>
                <li>@yield('title')</li>
            </ol>
        </div>

        <div class="col-md-7">
            <a href="{{ route('attendance.csv.download') }}"
                class="btn btn-success pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">
                <i class="fa fa-file" aria-hidden="true"></i> Download Sample with All Employee</a>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-info">
                <div class="panel-heading"><i class="mdi mdi-table fa-fw"></i> @yield('title')</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <div class="row">
                            <div id="searchBox">
                                {{ Form::open(['route' => 'attendance.csv', 'id' => 'employeeAttendance', 'method' => 'POST', 'class' => 'ajaxFormSubmit', 'data-redirect' => route('attendance.csv'), 'enctype' => 'multipart/form-data']) }}
                                <div class="col-md-2"></div>
                                <div class="col-md-3">
                                    <label class="control-label" for="email">@lang('common.date')<span
                                            class="validateRq">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="text" required class="form-control dateField required" readonly
                                            placeholder="@lang('common.date')" name="date"
                                            value="@if (isset($_REQUEST['date'])) {{ $_REQUEST['date'] }}@else{{ dateConvertDBtoForm(date('Y-m-d')) }} @endif">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group departmentName">
                                        <label class="control-label" for="email">@lang('CSV FILE')<span
                                                class="validateRq">*</span></label>
                                        <input type="file" required name="csv_file" id=""
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        {{-- <input type="submit" id="filter" style="margin-top: 25px; width: 100px;"
                                            class="btn btn-info " value="@lang('common.submit')"> --}}
                                        <button type="submit" id="filter" style="margin-top: 25px; width: 100px;"
                                            class="btn btn-info "><i class="fa fa-check"></i> @lang('common.submit')</button>
                                    </div>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
