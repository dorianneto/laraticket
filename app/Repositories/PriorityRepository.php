<?php

namespace App\Repositories;

use App\Repositories\AbstractRepository;
use App\Priority;

class PriorityRepository extends AbstractRepository
{
    /**
     * [__construct description]
     * @param Priority $model [description]
     */
    public function __construct(Priority $model)
    {
        parent::__construct($model);
    }
}
