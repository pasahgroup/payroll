@extends('admin.master')
@section('content')
@section('title')
    @lang('common.change_password')
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
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"><i class="mdi mdi-clipboard-text fa-fw"></i> @lang('common.change_password')</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        {{ Form::open(['route' => ['changePassword.update', Auth::user()->user_id], 'enctype' => 'multipart/form-data', 'id' => 'changePassword', 'class' => 'form-horizontal ajaxFormSubmit', 'method' => 'PUT', 'data-redirect' => url('dashboard')]) }}
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="control-label col-md-4">@lang('employee.user_name')<span
                                                class="validateRq">*</span></label>
                                        <div class="col-md-8">
                                            {!! Form::text(
                                                '',
                                                session('logged_session_data.user_name'),
                                                $attributes = ['class' => 'form-control user_name', 'id' => 'user_name', 'readonly' => 'readonly'],
                                            ) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="control-label col-md-4">@lang('passwords.old_password')<span
                                                class="validateRq">*</span></label>
                                        <div class="col-md-8">
                                            {!! Form::password(
                                                'oldPassword',
                                                $attributes = [
                                                    'class' => 'form-control required oldPassword',
                                                    'id' => 'oldPassword',
                                                    'placeholder' => __('passwords.old_password'),
                                                ],
                                            ) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="control-label col-md-4">@lang('passwords.new_password')<span
                                                class="validateRq">*</span></label>
                                        <div class="col-md-8">
                                            {!! Form::password(
                                                'password',
                                                $attributes = [
                                                    'class' => 'form-control required password',
                                                    'id' => 'password',
                                                    'placeholder' => __('passwords.new_password'),
                                                ],
                                            ) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="control-label col-md-4">@lang('passwords.confirm_password')<span
                                                class="validateRq">*</span></label>
                                        <div class="col-md-8">
                                            {!! Form::password(
                                                'password_confirmation',
                                                $attributes = [
                                                    'class' => 'form-control required password_confirmation',
                                                    'id' => 'password_confirmation',
                                                    'placeholder' => __('passwords.confirm_password'),
                                                ],
                                            ) !!}
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
                                            <button type="submit" class="btn btn-info btn_style"><i
                                                    class="fa fa-pencil"></i> @lang('common.update') </button>
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
