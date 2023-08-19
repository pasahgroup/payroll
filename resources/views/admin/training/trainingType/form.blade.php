@extends('admin.master')
@section('content')
@section('title')
    @if (isset($editModeData))
        @lang('training.edit_training_type')
    @else
        @lang('training.add_training_type')
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
            <a href="{{ route('trainingType.index') }}"
                class="btn btn-success pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light"><i
                    class="fa fa-list-ul" aria-hidden="true"></i> @lang('training.view_training_type')
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"><i class="mdi mdi-clipboard-text fa-fw"></i>@yield('title')</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        @if (isset($editModeData))
                            {{ Form::model($editModeData, ['route' => ['trainingType.update', $editModeData->training_type_id], 'method' => 'PUT', 'files' => 'true', 'class' => 'form-horizontal ajaxFormSubmit', 'id' => 'trainingTypeForm', 'data-redirect' => route('trainingType.index')]) }}
                        @else
                            {{ Form::open(['route' => 'trainingType.store', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal ajaxFormSubmit', 'id' => 'trainingTypeForm', 'data-redirect' => route('trainingType.index')]) }}
                        @endif

                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="control-label col-md-4">@lang('training.training_type_name')<span
                                                class="validateRq">*</span></label>
                                        <div class="col-md-8">
                                            {!! Form::text(
                                                'training_type_name',
                                                Input::old('training_type_name'),
                                                $attributes = [
                                                    'class' => 'form-control required training_type_name',
                                                    'id' => 'training_type_name',
                                                    'placeholder' => __('training.training_type_name'),
                                                ],
                                            ) !!}
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
