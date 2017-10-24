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
        return Ticket::whereIn('situation', ['in progress', 'open'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * [findForRoom description]
     * @return [type] [description]
     */
    public function findForRoom($id)
    {
        return Ticket::with('users')->find($id);
    }

    /**
     * [assign description]
     * @return [type] [description]
     */
    public function assign($id, $referenceId, array $data)
    {
        $has_room = $this->findForRoom($id)->users()->count();
        $ticket = Ticket::find($id);


        if ($has_room == 0) {
            $update = $ticket->update(['situation' => 'in progress']);
        }

        return $ticket->users()->attach($referenceId, $data);
    }
}
