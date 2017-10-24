<div class="btn-group pull-right" role="group">
    @if (isset($archived))
        <a class="btn btn-default" data-toggle="collapse" href="#filterTicket">
            <i class="fa fa-filter" aria-hidden="true"></i> {{ trans('form.filter')}}
        </a>
    @endif

    @can('delete-ticket')
        @if (isset($archived))
            <a href="{{ route('ticket.archive') }}" class="btn btn-danger"><i class="fa fa-archive"></i> {{ trans_choice('miscellaneous.archived', 2) }}</a>
        @else
            <a href="{{ route('ticket.index') }}" class="btn btn-primary"><i class="fa fa-life-ring"></i> {{ trans_choice('miscellaneous.ticket', 2) }}</a>
        @endif
    @endcan
</div>