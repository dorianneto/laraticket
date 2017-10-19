<?php

namespace App\Repositories;

use App\Repositories\AbstractRepository;
use App\User;
use Auth;

class UserRepository extends AbstractRepository
{
    /**
     * [__construct description]
     * @param User $model [description]
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}
