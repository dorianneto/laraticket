<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository
{
    /**
     * [$model description]
     * @var [type]
     */
    protected $model;

    /**
     * [__construct description]
     * @param Model $model [description]
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * [getAll description]
     * @return [type] [description]
     */
    public function getAll()
    {
        return $this->model->get();
    }

    /**
     * [getAllBy description]
     * @param  [type] $where [description]
     * @return [type]     [description]
     */
    public function getAllBy(array $where)
    {
        return $this->model->where($where)->get();
    }

    /**
     * [getAllArchived description]
     * @return [type] [description]
     */
    public function getAllArchived()
    {
        return $this->model->onlyTrashed()->get();
    }

    /**
     * [findFor description]
     * @param  [type] $id [description]
     * @return [type]        [description]
     */
    public function findFor($id)
    {
        return $this->model->find($id);
    }

    /**
     * [store description]
     * @param  array  $data [description]
     * @return [type]       [description]
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * [update description]
     * @param  array  $data [description]
     * @return [type]       [description]
     */
    public function update($id, array $data)
    {
        return $this->model->find($id)->update($data);
    }

    /**
     * [delete description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }

    /**
     * [restore description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function restore($id)
    {
        return $this->model->withTrashed()->find($id)->restore();
    }
}
