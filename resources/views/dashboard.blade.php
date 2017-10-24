@extends('layouts.app')

@section('content')
    <div class="container">
        @can ('metric-ticket')
            <div class="row">
                <div class="col-md-3">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{ trans('miscellaneous.ticket_state', ['state' => 'abertos'])}}</h3>
                        </div>
                        <div class="panel-body text-center">
                            <h4>{{ $metrics['open']->count() }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{ trans('miscellaneous.ticket_state', ['state' => 'respondidos'])}}</h3>
                        </div>
                        <div class="panel-body text-center">
                            <h4>{{ $metrics['resolved']->count() }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{ trans('miscellaneous.ticket_state', ['state' => 'invalidados'])}}</h3>
                        </div>
                        <div class="panel-body text-center">
                            <h4>{{ $metrics['invalid']->count() }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{ trans('miscellaneous.ticket_state', ['state' => 'fechados'])}}</h3>
                        </div>
                        <div class="panel-body text-center">
                            <h4>{{ $metrics['closed']->count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        @endcan
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{ trans_choice('miscellaneous.my_ticket', 2)}}</h3>
                    </div>
                    <div class="panel-body">
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
                                @forelse ($myTickets as $ticket)
                                    <tr>
                                        <td>{{ $ticket->id }}</td>
                                        <td>
                                            <strong>{{ $ticket->title }}</strong><br>
                                            <span class="label label-default"><i class="fa fa-building" aria-hidden="true"></i> {{ $ticket->department->title }}</span>
                                            <span class="label label-default"><i class="fa fa-tag" aria-hidden="true"></i> {{ $ticket->category->title }}</span>
                                        </td>
                                        <td>{{ trans("miscellaneous.$ticket->situation") }}</td>
                                        <td>{{ $ticket->priority->title }}</td>
                                        <td>{{ $ticket->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <div class="btn-group">
                                                @can('show-ticket')
                                                    <a href="{{ route('ticket.room', $ticket->id) }}" class="btn btn-default btn-sm"><i class="fa fa-inbox"></i></a>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">{{ trans('message.no_results') }} <i class="fa fa-frown-o" aria-hidden="true"></i></td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @can ('list-ticket')
                        <div class="panel-footer">
                            <a href="{{ route('ticket.index') }}" class="btn btn-default btn-sm"><i class="fa fa-eye"></i> {{ trans('miscellaneous.show_all') }}</a>
                        </div>
                    @endcan
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{ trans('miscellaneous.my_profile') }}</h3>
                    </div>
                    <div class="panel-body text-center">
                        <img alt="140x140" data-src="holder.js/140x140" class="img-circle" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgdmlld0JveD0iMCAwIDE0MCAxNDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzE0MHgxNDAKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNWY0ZGVhZTliMyB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1ZjRkZWFlOWIzIj48cmVjdCB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjQzLjc2NTYyNSIgeT0iNzQuNSI+MTQweDE0MDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==" data-holder-rendered="true" style="width: 140px; height: 140px;">
                    </div>
                    <div class="panel-footer">
                        <a href="{{ route('user.profile') }}" class="btn btn-default btn-sm"><i class="fa fa-gears" aria-hidden="true"></i> {{ trans('miscellaneous.edit_profile') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
