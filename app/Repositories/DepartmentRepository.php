<?php

namespace App\Repositories;

use App\Repositories\AbstractRepository;
use App\Department;

class DepartmentRepository extends AbstractRepository
{
    /**
     * [__construct description]
     * @param Department $model [description]
     */
    public function __construct(Department $model)
    {
        parent::__construct($model);
    }
}
