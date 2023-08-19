@extends('admin.master')
@section('content')
@section('title')
    @if (isset($editModeData))
        @lang('award.edit_award')
    @else
        @lang('award.add_new_award')
    @endif
@endsection
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <ol class="breadcrumb">
                <li class="active breadcrumbColor"><a href="{{ url('dashboard') }}"><i class="fa fa-home"></i>
                        @lang('dashboard.dashboard')</a></li>
                <li>@yield('title')</li>
            </ol>
        </div>
        <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
            <a href="{{ route('award.index') }}"
                class="btn btn-success pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light"><i
                    class="fa fa-list-ul" aria-hidden="true"></i> @lang('award.view_award') </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"><i class="mdi mdi-clipboard-text fa-fw"></i>@yield('title')</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        @if (isset($editModeData))
                            {{ Form::model($editModeData, ['route' => ['award.update', $editModeData->employee_award_id], 'method' => 'PUT', 'files' => 'true', 'data-redirect' => route('award.index'), 'class' => 'form-horizontal ajaxFormSubmit', 'id' => 'awardForm']) }}
                        @else
                            {{ Form::open(['route' => 'award.store', 'enctype' => 'multipart/form-data', 'data-redirect' => route('award.index'), 'class' => 'form-horizontal ajaxFormSubmit', 'id' => 'awardForm']) }}
                        @endif

                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="control-label col-md-4">@lang('award.award_name')<span
                                                class="validateRq">*</span></label>
                                        <div class="col-md-8">
                                            {{ Form::select('award_name', employeeAward(), Input::old('award_name'), ['class' => 'form-control award_name required select2']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="control-label col-md-4">@lang('common.employee_name')<span
                                                class="validateRq">*</span></label>
                                        <div class="col-md-8 employee_id">
                                            {{ Form::select('employee_id', $employeeList, Input::old('employee_id'), ['class' => 'form-control employee_id required select2']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="control-label col-md-4">@lang('award.gift_item')<span
                                                class="validateRq">*</span></label>
                                        <div class="col-md-8">
                                            {!! Form::text(
                                                'gift_item',
                                                Input::old('gift_item'),
                                                $attributes = [
                                                    'class' => 'form-control required gift_item',
                                                    'id' => 'gift_item',
                                                    'placeholder' => __('award.gift_item'),
                                                ],
                                            ) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="control-label col-md-4">@lang('common.month')<span
                                                class="validateRq">*</span></label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                                {!! Form::text(
                                                    'month',
                                                    Input::old('month'),
                                                    $attributes = [
                                                        'class' => 'form-control required monthField',
                                                        'readonly' => 'readonly',
                                                        'id' => 'month',
                                                        'placeholder' => __('common.month'),
                                                    ],
                                                ) !!}
                                            </div>
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
                                            <button type="submit" class="btn btn-info btn_style">
                                                <i class="fa {{ isset($editModeData) ? 'fa-pencil' : 'fa-check' }}"></i>
                                                {{ isset($editModeData) ? __('common.update') : __('common.save') }}
                                            </button>
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
