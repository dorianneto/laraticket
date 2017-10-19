<?php

namespace App\Repositories;

use App\Repositories\AbstractRepository;
use App\Category;

class CategoryRepository extends AbstractRepository
{
    /**
     * [__construct description]
     * @param Category $model [description]
     */
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }
}
