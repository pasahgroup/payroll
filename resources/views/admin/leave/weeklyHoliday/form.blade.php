@extends('admin.master')
@section('content')
@section('title')
    @if (isset($editModeData))
        @lang('holiday.edit_weekly_holiday')
    @else
        @lang('holiday.add_weekly_holiday')
    @endif
@endsection

<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
            <ol class="breadcrumb">
                <li class="active breadcrumbColor"><a href="{{ url('dashboard') }}"><i class="fa fa-home"></i>
                        @lang('dashboard.dashboard')</a></li>
                <li>@yield('title')</li>

            </ol>
        </div>
        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
            <a href="{{ route('weeklyHoliday.index') }}"
                class="btn btn-success pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light"><i
                    class="fa fa-list-ul" aria-hidden="true"></i> @lang('holiday.view_weekly_holiday')</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"><i class="mdi mdi-clipboard-text fa-fw"></i>@yield('title')</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        @if (isset($editModeData))
                            {{ Form::model($editModeData, ['route' => ['weeklyHoliday.update', $editModeData->week_holiday_id], 'method' => 'PUT', 'files' => 'true', 'id' => 'weeklyHolidayForm', 'class' => 'form-horizontal ajaxFormSubmit', 'data-redirect' => route('weeklyHoliday.index')]) }}
                        @else
                            {{ Form::open(['route' => 'weeklyHoliday.store', 'enctype' => 'multipart/form-data', 'id' => 'weeklyHoliday', 'class' => 'form-horizontal ajaxFormSubmit', 'data-redirect' => route('weeklyHoliday.index')]) }}
                        @endif
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="control-label col-md-4">@lang('holiday.holiday_name')<span
                                                class="validateRq">*</span></label>
                                        <div class="col-md-8 day_name">
                                            {{ Form::select('day_name', $weekList, Input::old('day_name'), ['class' => 'form-control day_name select2 required']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="control-label col-md-4">@lang('common.status')<span
                                                class="validateRq">*</span></label>
                                        <div class="col-md-8">
                                            {{ Form::select('status', ['1' => __('common.active'), '2' => __('common.inactive')], Input::old('status'), ['class' => 'form-control status select2 required']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-offset-4 col-md-8">
                                            @if (isset($editModeData))
                                                <button type="submit" class="btn btn-info btn_style"><i
                                                        class="fa fa-pencil"></i> @lang('common.update')</button>
                                            @else
                                                <button type="submit" class="btn btn-info btn_style"><i
                                                        class="fa fa-check"></i> @lang('common.save')</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
