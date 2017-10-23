<?php

namespace App\Http\Controllers;

use App\Foundation\Crud;
use App\Repositories\PriorityRepository;

class PriorityController extends Controller
{
    use Crud;

    /**
     * Undocumented function
     *
     * @param PriorityRepository $priorityRepository
     */
    public function __construct(PriorityRepository $priorityRepository)
    {
        parent::__construct();

        app()->bind('App\Http\Requests\FormRequestInterface', 'App\Http\Requests\PriorityRequest');

        $this->repository = $priorityRepository;
        $this->module     = 'priority';
    }
}
