@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Quantidade de tickets</h3>
                    </div>
                    <div class="panel-body text-center">
                        0
                    </div>
                    <div class="panel-footer">
                        <a href="#" class="btn btn-default btn-sm"><i class="fa fa-eye"></i> Visualizar</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">Lorem ipsum dolor</h3>
                    </div>
                    <div class="panel-body">
                        Panel body
                    </div>
                    <div class="panel-footer">Panel footer</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <h3 class="panel-title">Lorem ipsum dolor</h3>
                    </div>
                    <div class="panel-body">
                        Panel body
                    </div>
                    <div class="panel-footer">Panel footer</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">Lorem ipsum dolor</h3>
                    </div>
                    <div class="panel-body">
                        Panel body
                    </div>
                    <div class="panel-footer">Panel footer</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Meus tickets</h3>
                    </div>
                    <div class="panel-body">
                        Panel content
                    </div>
                    <div class="panel-footer">
                        <a href="#" class="btn btn-default btn-sm"><i class="fa fa-eye"></i> Visualizar</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Lorem ipsum dolor</h3>
                    </div>
                    <div class="panel-body">
                        Panel content
                    </div>
                    <div class="panel-footer">Panel footer</div>
                </div>
            </div>
        </div>
    </div>
@endsection
