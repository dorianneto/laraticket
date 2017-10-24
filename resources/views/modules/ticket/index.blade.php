@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            @include('modules.ticket.partials.actions', ['archived' => true])
            <h1>{{ trans('module.ticket.title') }}</h1>
        </div>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}">{{ trans('miscellaneous.dashboard') }}</a></li>
            <li class="active">{{ trans('module.ticket.title') }}</li>
        </ol>
        @include('modules.ticket.partials.filter')
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
                                @can('show-ticket')
                                    <a href="{{ route('ticket.room', $item->id) }}" class="btn btn-default btn-sm"><i class="fa fa-inbox"></i></a>
                                @endcan

                                @can('delete-ticket')
                                    <a href="#" class="btn btn-danger btn-sm pull-right"
                                        onclick="event.preventDefault();
                                                document.getElementById('archive-{{ $item->id }}').submit();">
                                        <i class="fa fa-archive"></i>
                                    </a>
                                @endcan
                            </div>

                            <form id="archive-{{ $item->id }}" action="{{ route('ticket.archivePost', $item->id) }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
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
        @if ($data instanceof \Illuminate\Pagination\LengthAwarePaginator)
            {{ $data->links() }}
        @endif
    </div>
@endsection
