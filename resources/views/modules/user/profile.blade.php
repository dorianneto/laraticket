@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <h1>Configurações da conta</h1>
        </div>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
            <li class="active">Configurações da conta</li>
        </ol>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Configurações dos dados da conta</h3>
                    </div>
                    <form action="{{ route('user.profileUpdate') }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="panel-body">
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="inputName">Seu nome*</label>
                                <input type="text" name="name" class="form-control" id="inputName" value="{{ $data->name }}">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="inputEmail">Seu email*</label>
                                <input type="email" name="email" class="form-control" id="inputEmail" value="{{ $data->email }}">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
                                <label for="inputCurrentPassowrd">Senha atual</label>
                                <input type="password" name="current_password" class="form-control" id="inputCurrentPassowrd" value="{{ old('current_password') }}">
                                @if ($errors->has('current_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('current_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="inputNewPassword">Nova senha</label>
                                <input type="password" name="password" class="form-control" id="inputNewPassword" value="{{ old('password') }}">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="inputConfirmNewPassowrd">Repetição da nova senha</label>
                                <input type="password" name="password_confirmation" class="form-control" id="inputConfirmNewPassowrd" value="{{ old('password_confirmation') }}">
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="panel-footer">
                            <button type="submit" class="btn btn-default">Salvar</button>
                            <a href="#" class="btn btn-link">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
