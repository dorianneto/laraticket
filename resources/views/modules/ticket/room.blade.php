@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <h1>{{ trans_choice('miscellaneous.ticket', 1) }} #{{ $data->id }}</h1>
            <h2>{{ $data->title }}</h2>
        </div>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}">{{ trans('miscellaneous.dashboard') }}</a></li>
            <li><a href="{{ route('ticket.index') }}">{{ trans('module.ticket.title') }}</a></li>
            <li class="active">{{ trans_choice('miscellaneous.ticket', 1) }} #{{ $data->id }} - {{ $data->title }}</li>
        </ol>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{ trans('module.ticket.show_subtitle') }}</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label>{{ trans('form.requester') }}</label>
                            <input type="text" class="form-control" value="{{ $data->user->name }}" readonly disabled>
                        </div>
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label>{{ trans('form.title') }}</label>
                            <input type="text" class="form-control" value="{{ $data->title }}" readonly disabled>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <span class="label label-default"><i class="fa fa-building" aria-hidden="true"></i> {{ $data->department->title }}</span>
                        <span class="label label-default"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> {{ $data->priority->title }}</span>
                        <span class="label label-default"><i class="fa fa-tag" aria-hidden="true"></i> {{ $data->category->title }}</span>
                        <span class="label label-default"><i class="fa fa-clock-o" aria-hidden="true"></i> {{ $data->created_at->format('d/m/Y') }}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    @foreach($messages as $key => $user)
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" href="#collapse-{{ $key }}" aria-expanded="true" aria-controls="collapse-{{ $key }}">
                                        {{ trans('form.message') }} <span class="badge">#{{ $key }}</span>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse-{{ $key }}" class="panel-collapse collapse {{ ($messages->count()-1) == $key ? 'in' : null }}" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    {{ $user->pivot->message }}
                                </div>
                                <div class="panel-footer">
                                    <span class="label label-default"><i class="fa fa-user" aria-hidden="true"></i> {{ $user->name }}</span>
                                    <span class="label label-default"><i class="fa fa-clock-o" aria-hidden="true"></i> {{ $user->pivot->created_at->format('d/m/Y H:m:s') }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            @if (in_array($data->situation, ['closed', 'invalid', 'resolved']))
                <div class="col-md-12">
                    <div class="alert alert-{{ $data->situation == 'resolved' ? 'success' : ($data->situation == 'invalid' ? 'warning' : 'danger') }} text-center">
                        <strong>
                            <i class="fa fa-{{ $data->situation == 'resolved' ? 'check' : ($data->situation == 'invalid' ? 'exclamation' : 'times') }}" aria-hidden="true"></i> Ticket {{ strtolower(trans("miscellaneous.{$data->situation}")) }}
                        </strong>
                    </div>
                </div>
            @endif

            <div class="col-md-12">
                <div class="panel panel-default">
                    <form action="{{ route('ticket.roomPost', $data->id) }}" id="roomForm" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" id="action" name="action">

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

                        <div class="panel-footer">
                            @if (in_array($data->situation, ['in progress', 'open']))
                                <button type="submit" class="btn btn-default"><i class="fa fa-floppy-o" aria-hidden="true"></i> {{ trans('form.save') }}</button>
                            @endif

                            @can('action-ticket')
                                @if (!in_array($data->situation, ['closed', 'invalid', 'resolved']))
                                    <button type="submit" class="btn btn-success"
                                        onclick="event.preventDefault();
                                        document.getElementById('action').value = 'resolved';
                                        document.getElementById('roomForm').submit();">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                    </button>
                                @endif

                                @if (in_array($data->situation, ['closed', 'invalid', 'resolved']))
                                    <button type="submit" class="btn btn-success"
                                        onclick="event.preventDefault();
                                        document.getElementById('action').value = 'in progress';
                                        document.getElementById('roomForm').submit();">
                                        <i class="fa fa-refresh" aria-hidden="true"></i>
                                    </button>
                                @endif

                                @if (!in_array($data->situation, ['closed', 'invalid', 'resolved']))
                                    <button type="submit" class="btn btn-warning"
                                        onclick="event.preventDefault();
                                        document.getElementById('action').value = 'invalid';
                                        document.getElementById('roomForm').submit();">
                                        <i class="fa fa-exclamation" aria-hidden="true"></i>
                                    </button>
                                    <button type="submit" class="btn btn-danger"
                                        onclick="event.preventDefault();
                                        document.getElementById('action').value = 'closed';
                                        document.getElementById('roomForm').submit();">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </button>
                                @endif
                            @endcan
                            <a href="{{ route('ticket.index') }}" class="btn btn-link">{{ trans('form.cancel') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
