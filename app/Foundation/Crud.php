<?php

namespace App\Foundation;

use App\Http\Requests\FormRequestInterface;

Trait Crud
{
    /**
     * Undocumented variable
     *
     * @var [type]
     */
    protected $repository;

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    protected $module;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->repository->getAll();

        return view("modules.{$this->module}.index", compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("modules.{$this->module}.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\FormRequestInterface  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormRequestInterface $request)
    {
        try {
            $team = $this->repository->store($request->except('_token'));

            $notice = [
                'status' => 'success',
                'message' => trans("notice.{$this->module}.success", ['action' => 'cadastrad'])
            ];
        } catch (\Illuminate\Database\QueryException $exception) {
            $notice = [
                'status' => 'danger',
                'message' => trans("notice.{$this->module}.error", ['action' => 'cadastrar'])
            ];
        }

        return redirect()->route("{$this->module}.index")->with(compact('notice'));
    }

    /**
     * Show the dashboard for a specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->repository->findFor($id);

        return view("modules.{$this->module}.show", compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->repository->findFor($id);

        return view("modules.{$this->module}.edit", compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\FormRequestInterface  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FormRequestInterface $request, $id)
    {
        try {
            $this->repository->update($id, $request->except('_token', '_method'));

            $notice = [
                'status' => 'success',
                'message' => trans("notice.{$this->module}.success", ['action' => 'editad'])
            ];
        } catch (\Illuminate\Database\QueryException $exception) {
            $notice = [
                'status' => 'danger',
                'message' => trans("notice.{$this->module}.error", ['action' => 'editar'])
            ];
        }

        return redirect()->route("{$this->module}.index")->with(compact('notice'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->repository->delete($id);

            $notice = [
                'status' => 'success',
                'message' => trans("notice.{$this->module}.success", ['action' => 'excluíd'])
            ];
        } catch (\Illuminate\Database\QueryException $exception) {
            $notice = [
                'status' => 'danger',
                'message' => trans("notice.{$this->module}.error", ['action' => 'excluir'])
            ];
        }

        return redirect()->route("{$this->module}.index")->with(compact('notice'));
    }
}
