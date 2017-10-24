<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TicketRepository;

class DashboardController extends Controller
{

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    protected $ticketRepository;

    /**
     * Undocumented function
     *
     * @param TicketRepository $ticketRepository
     */
    public function __construct(TicketRepository $ticketRepository) {
        parent::__construct();

        $this->ticketRepository = $ticketRepository;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function index()
    {
        $myTickets = $this->ticketRepository->getMyTickets();
        $metrics   = $this->ticketRepository->getTicketMetrics();

        return view('dashboard', compact('myTickets', 'metrics'));
    }
}
