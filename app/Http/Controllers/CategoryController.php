<?php

namespace App\Http\Controllers;

use App\Foundation\Crud;
use App\Repositories\CategoryRepository;

class CategoryController extends Controller
{
    use Crud;

    /**
     * Undocumented function
     *
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        parent::__construct();

        app()->bind('App\Http\Requests\FormRequestInterface', 'App\Http\Requests\CategoryRequest');

        $this->repository = $categoryRepository;
        $this->module     = 'category';
    }
}
