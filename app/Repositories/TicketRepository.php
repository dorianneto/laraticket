<?php

namespace App\Repositories;

use App\Repositories\AbstractRepository;
use App\Ticket;

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
}
