@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            @include('modules.priority.partials.actions')
            <h1>{{ trans('module.priority.title') }}</h1>
        </div>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}">{{ trans('miscellaneous.dashboard') }}</a></li>
            <li>{{ trans_choice('miscellaneous.auxiliary', 2) }}</li>
            <li class="active">{{ trans('module.priority.title') }}</li>
        </ol>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th width="5%">{{ trans('form.id_column') }}</th>
                    <th width="45%">{{ trans('form.title') }}</th>
                    <th width="30%">{{ trans('form.created_at') }}</th>
                    <th width="20%">{{ trans('form.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->created_at->format('d/m/Y') }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('priority.edit', $item->id) }}" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> {{ trans('form.edit') }}</a>
                                <a href="{{ route('priority.show', $item->id) }}" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i> {{ trans('form.show') }}</a>
                                <a href="#" class="btn btn-danger btn-sm pull-right"
                                    onclick="event.preventDefault();
                                            document.getElementById('delete-{{ $item->id }}').submit();">
                                    <i class="fa fa-trash"></i> {{ trans('form.destroy') }}
                                </a>
                            </div>

                            <form id="delete-{{ $item->id }}" action="{{ route('priority.destroy', $item->id) }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">{{ trans('message.no_results') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
