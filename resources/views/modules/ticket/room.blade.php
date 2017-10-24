@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <h1>Ticket #{{ $data->id }}</h1>
            <h2>{{ $data->title }}</h2>
        </div>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}">{{ trans('miscellaneous.dashboard') }}</a></li>
            <li><a href="{{ route('ticket.index') }}">{{ trans('module.ticket.title') }}</a></li>
            <li class="active">Ticket #{{ $data->id }} - {{ $data->title }}</li>
        </ol>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Informações do ticket</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label>Solicitante</label>
                            <input type="text" class="form-control" value="{{ $data->user->name }}" readonly disabled>
                        </div>
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label>{{ trans('form.title') }}</label>
                            <input type="text" class="form-control" value="{{ $data->title }}" readonly disabled>
                        </div>
                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label>{{ trans('form.message') }}</label>
                            <textarea name="description" class="form-control" rows="5" readonly disabled>{{ $data->message }}</textarea>
                            @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="panel-footer">
                        <span class="label label-default">Departamento: {{ $data->department->title }}</span>
                        <span class="label label-default">Prioridade: {{ $data->priority->title }}</span>
                        <span class="label label-default">Categoria: {{ $data->category->title }}</span>
                        <span class="label label-default">Criado em: {{ $data->created_at->format('d/m/Y') }}</span>
                    </div>
                </div>
            </div>

            @foreach($data->users as $key => $user)
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">#{{ $key }} {{ trans('form.message') }}</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                                <textarea name="message" class="form-control" rows="5" readonly disabled>{{ $user->pivot->message }}</textarea>
                            </div>
                        </div>

                        <div class="panel-footer">
                            <span class="label label-default">Por: {{ $user->name }}</span>
                        </div>
                    </div>
                </div>
            @endforeach

            @if (in_array($data->situation, ['closed', 'invalid', 'resolved']))
                <div class="col-md-12">
                    <div class="alert alert-info text-center">
                        <strong>Ticket encerrado</strong>
                    </div>
                </div>
            @endif

            <div class="col-md-12">
                <div class="panel panel-default">
                    <form action="{{ route('ticket.roomPost', $data->id) }}" id="roomForm" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" id="action" name="action">

                        @if (in_array($data->situation, ['in progress', 'open']))
                            <div class="panel-body">
                                <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                                    <label for="textareaMessage">{{ trans('form.message') }}</label>
                                    <textarea name="message" class="form-control" id="textareaMessage" rows="5">{{ old('message') }}</textarea>
                                    @if ($errors->has('message'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('message') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @endif

                        <div class="panel-footer">
                            @if (in_array($data->situation, ['in progress', 'open']))
                                <button type="submit" class="btn btn-default">{{ trans('form.save') }}</button>
                            @endif

                            @if ($data->users()->count() > 0)
                                @if (!in_array($data->situation, ['closed', 'invalid', 'resolved']))
                                    <button type="submit" class="btn btn-success"
                                        onclick="event.preventDefault();
                                        document.getElementById('action').value = 'resolved';
                                        document.getElementById('roomForm').submit();">
                                        Resolver
                                    </button>
                                @endif

                                @if (in_array($data->situation, ['closed', 'invalid', 'resolved']))
                                    <button type="submit" class="btn btn-success"
                                        onclick="event.preventDefault();
                                        document.getElementById('action').value = 'in progress';
                                        document.getElementById('roomForm').submit();">
                                        Reabrir
                                    </button>
                                @endif

                                @if (!in_array($data->situation, ['closed', 'invalid', 'resolved']))
                                    <button type="submit" class="btn btn-warning"
                                        onclick="event.preventDefault();
                                        document.getElementById('action').value = 'invalid';
                                        document.getElementById('roomForm').submit();">
                                        Invalidar
                                    </button>
                                    <button type="submit" class="btn btn-danger"
                                        onclick="event.preventDefault();
                                        document.getElementById('action').value = 'closed';
                                        document.getElementById('roomForm').submit();">
                                        Fechar
                                    </button>
                                @endif
                            @endif
                            <a href="{{ route('ticket.index') }}" class="btn btn-link">{{ trans('form.cancel') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
