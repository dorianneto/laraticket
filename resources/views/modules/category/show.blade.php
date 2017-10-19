@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <h1>Visualizar categoria</h1>
        </div>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
            <li>Auxiliares</li>
            <li><a href="{{ route('category.index') }}">Categorias</a></li>
            <li class="active">Visualizar categoria</li>
        </ol>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Visualizar informações da categoria</h3>
                    </div>
                    <form>
                        <div class="panel-body">
                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="inputName">Título*</label>
                                <input type="text" class="form-control" value="{{ $data->title }}" disabled>
                            </div>
                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="textareaDescription">Descrição</label>
                                <textarea class="form-control" rows="5" disabled>{{ $data->description }}</textarea>
                            </div>
                        </div>

                        <div class="panel-footer">
                            <a href="{{ route('category.edit', $data->id) }}" class="btn btn-default">Editar</a>
                            <a href="{{ route('category.index') }}" class="btn btn-link">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
