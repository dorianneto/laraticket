<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Repositories\CategoryRepository;
use Auth;

class CategoryController extends Controller
{
    /**
     * [$categoryRepository description]
     * @var [CategoryRepository]
     */
    protected $categoryRepository;

    /**
     * [__construct description]
     * @param CategoryRepository $categoryRepository [description]
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        parent::__construct();
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->categoryRepository->getAll();

        return view('modules.category.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\CategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        try {
            $team = $this->categoryRepository->store($request->except('_token'));

            $notice = [
                'status' => 'success',
                'message' => 'Categoria cadastrada com sucesso!'
            ];
        } catch (\Illuminate\Database\QueryException $exception) {
            $notice = [
                'status' => 'danger',
                'message' => "Erro ao cadastrar categoria."
            ];
        }

        return redirect()->route('category.index')->with(compact('notice'));
    }

    /**
     * Show the dashboard for a specified resource.
     *
     * @param  int  $categoryId
     * @return \Illuminate\Http\Response
     */
    public function show($categoryId)
    {
        $data = $this->categoryRepository->findFor($categoryId);

        return view('modules.category.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $categoryId
     * @return \Illuminate\Http\Response
     */
    public function edit($categoryId)
    {
        $data = $this->categoryRepository->findFor($categoryId);

        return view('modules.category.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\CategoryRequest  $request
     * @param  int  $categoryId
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $categoryId)
    {
        try {
            $this->categoryRepository->update($categoryId, $request->except('_token', '_method'));

            $notice = [
                'status' => 'success',
                'message' => 'Categoria atualizada com sucesso!'
            ];
        } catch (\Illuminate\Database\QueryException $exception) {
            $notice = [
                'status' => 'danger',
                'message' => 'Erro ao editar categoria.'
            ];
        }

        return redirect()->route('category.index')->with(compact('notice'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $categoryId
     * @return \Illuminate\Http\Response
     */
    public function destroy($categoryId)
    {
        try {
            $this->categoryRepository->delete($categoryId);

            $notice = [
                'status' => 'success',
                'message' => 'Categoria excluída com sucesso!'
            ];
        } catch (\Illuminate\Database\QueryException $exception) {
            $notice = [
                'status' => 'danger',
                'message' => 'Erro ao excluir categoria.'
            ];
        }

        return redirect()->route('category.index')->with(compact('notice'));
    }
}
