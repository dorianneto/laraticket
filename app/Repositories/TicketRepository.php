<?php

namespace App\Repositories;

use App\Repositories\AbstractRepository;
use App\Ticket;
use Auth;

class TicketRepository extends AbstractRepository
{
    /**
     * [__construct description]
     * @param Ticket $model [description]
     */
    public function __construct(Ticket $model)
    {
        parent::__construct($model);
    }

    /**
     * [getAll description]
     * @return [type] [description]
     */
    public function getAll()
    {
        return Ticket::where(function($query) {
                return $query->whereNull('user_id')
                    ->orWhere('user_id', Auth::user()->id);
            })
            ->where('situation', 'open')
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
