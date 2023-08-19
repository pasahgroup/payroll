@extends('admin.master')
@section('content')
@section('title')
    @if (isset($editModeData))
        @lang('performance.edit_performance_criteria')
    @else
        @lang('performance.add_performance_criteria')
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
            <a href="{{ route('performanceCriteria.index') }}"
                class="btn btn-success pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light"><i
                    class="fa fa-list-ul" aria-hidden="true"></i> @lang('performance.view_performance_criteria')</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"><i class="mdi mdi-clipboard-text fa-fw"></i>@yield('title')</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        @if (isset($editModeData))
                            {{ Form::model($editModeData, ['route' => ['performanceCriteria.update', $editModeData->performance_criteria_id], 'method' => 'PUT', 'files' => 'true', 'class' => 'form-horizontal ajaxFormSubmit', 'id' => 'pfCat', 'data-redirect' => route('performanceCriteria.index')]) }}
                        @else
                            {{ Form::open(['route' => 'performanceCriteria.store', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal ajaxFormSubmit', 'id' => 'pfCat', 'data-redirect' => route('performanceCriteria.index')]) }}
                        @endif
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="control-label col-md-4">@lang('performance.category_name')<span
                                                class="validateRq">*</span></label>
                                        <div class="col-md-8">
                                            {{ Form::select('performance_category_id', $performanceCategory, Input::old('performance_category_id'), ['class' => 'form-control performance_category_id select2 required']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="control-label col-md-4">@lang('performance.criteria_name')<span
                                                class="validateRq">*</span></label>
                                        <div class="col-md-8">
                                            {!! Form::text(
                                                'performance_criteria_name',
                                                Input::old('performance_criteria_name'),
                                                $attributes = [
                                                    'class' => 'form-control required performance_criteria_name',
                                                    'id' => 'performance_criteria_name',
                                                    'placeholder' => __('performance.criteria_name'),
                                                ],
                                            ) !!}
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
                                                    <i
                                                        class="fa {{ isset($editModeData) ? 'fa-pencil' : 'fa-check' }}"></i>
                                                    {{ isset($editModeData) ? __('common.update') : __('common.save') }}
                                                </button>
                                            </div>
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
