@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            @include('modules.category.partials.actions')
            <h1>Categorias</h1>
        </div>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
            <li>Auxiliares</li>
            <li class="active">Categorias</li>
        </ol>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th width="45%">Título</th>
                    <th width="30%">Criado em</th>
                    <th width="20%">Ações</th>
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
                                <a href="{{ route('category.edit', $item->id) }}" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</a>
                                <a href="{{ route('category.show', $item->id) }}" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i> Visualizar</a>
                                <a href="#" class="btn btn-danger btn-sm pull-right"
                                    onclick="event.preventDefault();
                                            document.getElementById('delete-{{ $item->id }}').submit();">
                                    <i class="fa fa-trash"></i> Excluir
                                </a>
                            </div>

                            <form id="delete-{{ $item->id }}" action="{{ route('category.destroy', $item->id) }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Nenhum registro cadastrado</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
