@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <h1>{{ trans('module.profile.title') }}</h1>
        </div>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
            <li class="active">{{ trans('module.profile.title') }}</li>
        </ol>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{ trans('module.profile.subtitle') }}</h3>
                    </div>
                    <form action="{{ route('user.profileUpdate') }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="panel-body">
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="inputName">{{ trans('form.your_name') }}{!! trans('form.required_field') !!}</label>
                                <input type="text" name="name" class="form-control" id="inputName" value="{{ $data->name }}">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="inputEmail">{{ trans('form.your_email') }}{!! trans('form.required_field') !!}</label>
                                <input type="email" name="email" class="form-control" id="inputEmail" value="{{ $data->email }}">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
                                <label for="inputCurrentPassowrd">{{ trans('form.current_password') }}</label>
                                <input type="password" name="current_password" class="form-control" id="inputCurrentPassowrd" value="{{ old('current_password') }}">
                                @if ($errors->has('current_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('current_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="inputNewPassword">{{ trans('form.new_password') }}</label>
                                <input type="password" name="password" class="form-control" id="inputNewPassword" value="{{ old('password') }}">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="inputConfirmNewPassowrd">{{ trans('form.new_password_confirm') }}</label>
                                <input type="password" name="password_confirmation" class="form-control" id="inputConfirmNewPassowrd" value="{{ old('password_confirmation') }}">
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="panel-footer">
                            <button type="submit" class="btn btn-default"><i class="fa fa-floppy-o" aria-hidden="true"></i> {{ trans('form.save') }}</button>
                            <a href="#" class="btn btn-link">{{ trans('form.cancel') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
