@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <h1>{{ trans('module.priority.show_title') }}</h1>
        </div>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}">{{ trans('miscellaneous.dashboard') }}</a></li>
            <li>{{ trans_choice('miscellaneous.auxiliary', 2) }}</li>
            <li><a href="{{ route('priority.index') }}">{{ trans('module.priority.title') }}</a></li>
            <li class="active">{{ trans('module.priority.show_title') }}</li>
        </ol>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{ trans('module.priority.show_subtitle') }}</h3>
                    </div>
                    <form>
                        <div class="panel-body">
                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="inputName">{{ trans('form.title') }}{!! trans('form.required_field') !!}</label>
                                <input type="text" class="form-control" value="{{ $data->title }}" disabled>
                            </div>
                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="textareaDescription">{{ trans('form.description') }}</label>
                                <textarea class="form-control" rows="5" disabled>{{ $data->description }}</textarea>
                            </div>
                        </div>

                        <div class="panel-footer">
                            <a href="{{ route('priority.edit', $data->id) }}" class="btn btn-default"><i class="fa fa-pencil" aria-hidden="true"></i> {{ trans('form.edit') }}</a>
                            <a href="{{ route('priority.index') }}" class="btn btn-link">{{ trans('form.cancel') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
