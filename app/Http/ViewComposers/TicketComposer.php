<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\DepartmentRepository;
use App\Repositories\PriorityRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\TicketRepository;

class TicketComposer
{
    /**
     * Undocumented variable
     *
     * @var [type]
     */
    protected $departmentRepository;

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    protected $priorityRepository;

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    protected $categoryRepository;

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    protected $ticketRepository;

    /**
     * Undocumented function
     *
     * @param DepartmentRepository $departmentRepository
     * @param PriorityRepository $priorityRepository
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(
        TicketRepository $ticketRepository,
        DepartmentRepository $departmentRepository,
        PriorityRepository $priorityRepository,
        CategoryRepository $categoryRepository
    ) {
        $this->ticketRepository     = $ticketRepository;
        $this->departmentRepository = $departmentRepository;
        $this->priorityRepository   = $priorityRepository;
        $this->categoryRepository   = $categoryRepository;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $departments = $this->departmentRepository->getForSelect(['id', 'title']);
        $priorities  = $this->priorityRepository->getForSelect(['id', 'title']);
        $categories  = $this->categoryRepository->getForSelect(['id', 'title']);
        $situations  = $this->ticketRepository->getEnumValues('situation');

        $view->with('departments', $departments)
            ->with('priorities', $priorities)
            ->with('situations', $situations)
            ->with('categories', $categories);

    }
}
