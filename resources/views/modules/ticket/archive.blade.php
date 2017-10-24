@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            @include('modules.ticket.partials.actions')
            <h1>{{ trans_choice('miscellaneous.ticket', 2) }} <span class="badge">{{ strtolower(trans_choice('miscellaneous.archived', 2)) }}</span></h1>
        </div>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}">{{ trans('miscellaneous.dashboard') }}</a></li>
            <li><a href="{{ route('ticket.index') }}">{{ trans_choice('miscellaneous.ticket', 2) }}</a></li>
            <li class="active">{{ trans_choice('miscellaneous.archived', 2) }} </li>
        </ol>
        <div class="collapse clearfix" id="filterTicket">
            <div class="well">
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>{{ trans('form.id_column') }}</th>
                    <th>{{ trans('form.title') }}</th>
                    <th>{{ trans('form.situation') }}</th>
                    <th>{{ trans('form.priority') }}</th>
                    <th>{{ trans('form.created_at') }}</th>
                    <th>{{ trans('form.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>
                            <strong>{{ $item->title }}</strong><br>
                            <span class="label label-default"><i class="fa fa-building" aria-hidden="true"></i> {{ $item->department->title }}</span>
                            <span class="label label-default"><i class="fa fa-tag" aria-hidden="true"></i> {{ $item->category->title }}</span>
                        </td>
                        <td>{{ trans("miscellaneous.$item->situation") }}</td>
                        <td>{{ $item->priority->title }}</td>
                        <td>{{ $item->created_at->format('d/m/Y') }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="#" class="btn btn-success btn-sm"
                                    onclick="event.preventDefault();
                                            document.getElementById('restore-{{ $item->id }}').submit();">
                                    <i class="fa fa-refresh"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-sm"
                                    onclick="event.preventDefault();
                                            if (confirm('Deseja realmente excluir?')) { document.getElementById('delete-{{ $item->id }}').submit();} else { return false;}">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>

                            <form id="restore-{{ $item->id }}" action="{{ route('ticket.restore', $item->id) }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>

                            <form id="delete-{{ $item->id }}" action="{{ route('ticket.destroy', $item->id) }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">{{ trans('message.no_results') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
