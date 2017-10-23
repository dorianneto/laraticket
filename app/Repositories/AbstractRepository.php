<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use DB;

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
     * [getForSelect description]
     * @return [type] [description]
     */
    public function getForSelect(array $fields)
    {
        list($id, $name) = $fields;
        return $this->model->pluck($id, $name);
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

    /**
     * [getEnumValues description]
     * @return [type] [description]
     */
    public function getEnumValues($field)
    {
        $values = DB::raw('SHOW COLUMNS FROM ' . $this->model->getTable() . ' WHERE field = "' . $field . '"');
        $output = DB::select($values)[0]->Type;

        preg_match('/^enum\((.*)\)$/', $output, $matches);
        $values = array();

        foreach(explode(',', $matches[1]) as $value){
            $values[] = trim($value, "'");
        }

        return $values;
    }
}
