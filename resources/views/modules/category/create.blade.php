@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <h1>Nova categoria</h1>
        </div>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
            <li>Auxiliares</li>
            <li><a href="{{ route('category.index') }}">Categorias</a></li>
            <li class="active">Nova categoria</li>
        </ol>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Cadastro de nova categoria</h3>
                    </div>
                    <form action="{{ route('category.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="panel-body">
                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="inputName">Título*</label>
                                <input type="text" name="title" class="form-control" id="inputName" value="{{ old('title') }}">
                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="textareaDescription">Descrição</label>
                                <textarea name="description" class="form-control" id="textareaDescription" rows="5">{{ old('description') }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="panel-footer">
                            <button type="submit" class="btn btn-default">Salvar</button>
                            <a href="{{ route('category.index') }}" class="btn btn-link">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
