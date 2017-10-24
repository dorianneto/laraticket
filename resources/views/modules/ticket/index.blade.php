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
        <div class="collapse clearfix" id="filterTicket">
            <div class="well">
                <form action="{{ route('ticket.index') }}" method="post">
                    {{ csrf_field() }}
                    <div class="panel-body">
                        <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                            <label for="selectDepartment">{{ trans('form.department') }}</label>
                            <select name="department" id="selectSituation" class="form-control">
                                <option value="">Selecione uma opção</option>
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
                            <label for="selectCategory">{{ trans('form.category') }}</label>
                            <select name="category" id="selectSituation" class="form-control">
                                <option value="">Selecione uma opção</option>
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
                            <label for="selectPriority">{{ trans('form.priority') }}</label>
                            <select name="priority" id="selectSituation" class="form-control">
                                <option value="">Selecione uma opção</option>
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
                        <div class="form-group{{ $errors->has('situation') ? ' has-error' : '' }}">
                            <label for="selectSituation">Situação</label>
                            <select name="situation" id="selectSituation" class="form-control">
                                <option value="">Selecione uma opção</option>
                                @foreach($situations as $situation)
                                    <option value="{{ $situation }}">{{ $situation }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('situation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('situation') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="panel-footer">
                        <button type="submit" class="btn btn-default">Filtrar</button>
                        <a href="{{ route('ticket.index') }}" class="btn btn-default">Resetar</a>
                        <a data-toggle="collapse" href="#filterTicket" class="btn btn-link">{{ trans('form.cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>{{ trans('form.id_column') }}</th>
                    <th>{{ trans('form.title') }}</th>
                    <th>Situação</th>
                    <th>Prioridade</th>
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
                            <span class="label label-default">Departamento: {{ $item->department->title }}</span>
                            <span class="label label-default">Categoria: {{ $item->category->title }}</span>
                        </td>
                        <td>{{ trans("miscellaneous.$item->situation") }}</td>
                        <td>{{ $item->priority->title }}</td>
                        <td>{{ $item->created_at->format('d/m/Y') }}</td>
                        <td>
                            <div class="btn-group">
                                @can('show-ticket')
                                    <a href="{{ route('ticket.room', $item->id) }}" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Acessar</a>
                                @endcan

                                @can('delete-ticket')
                                    <a href="#" class="btn btn-danger btn-sm pull-right"
                                        onclick="event.preventDefault();
                                                document.getElementById('archive-{{ $item->id }}').submit();">
                                        <i class="fa fa-trash"></i> Arquivar
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
                        <td colspan="4">{{ trans('message.no_results') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        @if ($data instanceof \Illuminate\Pagination\LengthAwarePaginator)
            {{ $data->links() }}
        @endif
    </div>
@endsection
