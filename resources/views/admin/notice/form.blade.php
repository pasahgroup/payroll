@extends('admin.master')
@section('content')
@section('title')
    @if (isset($editModeData))
        @lang('notice.edi_notice')
    @else
        @lang('notice.add_new_notice')
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
            <a href="{{ route('notice.index') }}"
                class="btn btn-success pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light"><i
                    class="fa fa-list-ul" aria-hidden="true"></i> @lang('notice.view_notice') </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"><i class="mdi mdi-clipboard-text fa-fw"></i>@yield('title')</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        @if (isset($editModeData))
                            {{ Form::model($editModeData, ['route' => ['notice.update', $editModeData->notice_id], 'method' => 'PUT', 'files' => 'true', 'data-redirect' => route('notice.index'), 'class' => 'form-horizontal ajaxFormSubmit', 'id' => 'noticeForm']) }}
                        @else
                            {{ Form::open(['route' => 'notice.store', 'enctype' => 'multipart/form-data', 'data-redirect' => route('notice.index'), 'class' => 'form-horizontal ajaxFormSubmit', 'id' => 'noticeForm']) }}
                        @endif

                        <div class="form-body">

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="control-label col-md-4">@lang('notice.title')<span
                                                class="validateRq">*</span></label>
                                        <div class="col-md-8">
                                            {!! Form::text(
                                                'title',
                                                Input::old('title'),
                                                $attributes = ['class' => 'form-control required title', 'id' => 'title', 'placeholder' => __('notice.title')],
                                            ) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="control-label col-md-4">@lang('notice.description')<span
                                                class="validateRq">*</span></label>
                                        <div class="col-md-8 description">
                                            {!! Form::textarea(
                                                'description',
                                                Input::old('description'),
                                                $attributes = [
                                                    'class' => 'form-control textarea_editor required',
                                                    'rows' => '15',
                                                    'id' => 'description',
                                                    'placeholder' => __('notice.description'),
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
                                        <div class="col-md-8 status">
                                            {{ Form::select('status', ['Published' => __('recruitement.published'), 'Unpublished' => __('recruitement.unpublished')], Input::old('status'), ['class' => 'form-control status select2 required']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="control-label col-md-4">@lang('notice.publish_date')<span
                                                class="validateRq">*</span></label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                                {!! Form::text(
                                                    'publish_date',
                                                    isset($editModeData) ? dateConvertDBtoForm($editModeData->publish_date) : Input::old('publish_date'),
                                                    $attributes = [
                                                        'class' => 'form-control dateField',
                                                        'id' => 'publish_date',
                                                        'readonly' => 'readonly',
                                                        'placeholder' => __('notice.publish_date'),
                                                    ],
                                                ) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="control-label col-md-4">@lang('notice.attach_file')</label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-files-o"></i></div>
                                                {!! Form::file('attach_file', $attributes = ['class' => 'form-control']) !!}
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

@section('page_scripts')
<link rel="stylesheet" href="{!! asset('admin_assets/plugins/bower_components/html5-editor/bootstrap-wysihtml5.css') !!}" />
<script src="{!! asset('admin_assets/js/cbpFWTabs.js') !!}"></script>
<script src="{!! asset('admin_assets/plugins/bower_components/html5-editor/wysihtml5-0.3.0.js') !!}"></script>
<script src="{!! asset('admin_assets/plugins/bower_components/html5-editor/bootstrap-wysihtml5.js') !!}"></script>

<script type="text/javascript">
    (function() {
        $('.textarea_editor').wysihtml5();

        [].slice.call(document.querySelectorAll('.sttabs')).forEach(function(el) {
            new CBPFWTabs(el);
        });
    })();
</script>
@endsection
