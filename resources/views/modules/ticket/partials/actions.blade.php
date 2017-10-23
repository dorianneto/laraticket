<div class="btn-group pull-right" role="group">
    <a class="btn btn-default" data-toggle="collapse" href="#filterTicket">
        Filtrar
    </a>
    @if (isset($archived))
        <a href="{{ route('ticket.archive') }}" class="btn btn-danger"><i class="fa fa-plus-circle"></i> Arquivados</a>
    @else
        <a href="{{ route('ticket.index') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Tickets</a>
    @endif
</div>