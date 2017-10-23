@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <h1>{{ trans('module.ticket.add_title') }}</h1>
        </div>
        <ol class="breadcrumb">
            <li><a href="{{ route('login') }}">{{ trans('miscellaneous.login') }}</a></li>
            <li class="active">{{ trans('module.ticket.add_title') }}</li>
        </ol>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{ trans('module.ticket.add_subtitle') }}</h3>
                    </div>
                    <form action="{{ route('ticket.storeReport') }}" method="post">
                        {{ csrf_field() }}
                        <div class="panel-body">
                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="inputName">{{ trans('form.title') }}{!! trans('form.required_field') !!}</label>
                                <input type="text" name="title" class="form-control" id="inputName" value="{{ old('title') }}">
                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                                <label for="textareaDescription">{{ trans('form.message') }}{!! trans('form.required_field') !!}</label>
                                <textarea name="message" class="form-control" id="textareaMessage" rows="5">{{ old('message') }}</textarea>
                                @if ($errors->has('message'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                                <label for="selectDepartment">{{ trans('form.department') }}{!! trans('form.required_field') !!}</label>
                                <select name="department" id="selectSituation" class="form-control">
                                    @foreach($departments as $department => $departmentId)
                                        <option value="{{ $departmentId }}">{{ $department }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('department'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('department') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                                <label for="selectCategory">{{ trans('form.category') }}{!! trans('form.required_field') !!}</label>
                                <select name="category" id="selectSituation" class="form-control">
                                    @foreach($categories as $category => $categoryId)
                                        <option value="{{ $categoryId }}">{{ $category }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('category'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('priority') ? ' has-error' : '' }}">
                                <label for="selectPriority">{{ trans('form.priority') }}{!! trans('form.required_field') !!}</label>
                                <select name="priority" id="selectSituation" class="form-control">
                                    @foreach($priorities as $priority => $priorityId)
                                        <option value="{{ $priorityId }}">{{ $priority }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('priority'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('priority') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="panel-footer">
                            <button type="submit" class="btn btn-default">{{ trans('form.save') }}</button>
                            <a href="{{ route('ticket.index') }}" class="btn btn-link">{{ trans('form.cancel') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
