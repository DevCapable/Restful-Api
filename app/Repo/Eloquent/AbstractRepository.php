<?php

namespace App\Repo\Eloquent;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository
{

    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;

    }

    public function getNew(array $attributes = array())
    {
        return $this->model->newInstance($attributes);
    }

    public function findAll($orderColumn = 'title', $orderDir = 'asc', $cols = array('*'))
    {
        $model = $this->model
            ->orderBy($orderColumn, $orderDir)
            ->get($cols);
        return $model;
    }

    public function findAllWithoutGet($orderColumn = 'title', $orderDir = 'asc', $cols = array('*'))
    {
        $model = $this->model->get();
        //$obj = new Collection($model);
        return $model;
    }

    public function findLimit($limit, $orderColumn = 'title', $orderDir = 'asc', $cols = array('*'))
    {
        $model = $this->model
            ->orderBy($orderColumn, $orderDir)
            ->limit($limit)
            ->get($cols);

        return $model;
    }

    public function orderedList($key, $value, $default = NULL)
    {
        $model = $this->model->orderBy($value)->lists($value, $key);
        if ($default != NULL) $model = array_add($model, '', $default);
        return $model;
    }


    public function listAllToJson(array $list, $order = NULL)
    {
        $model = $this->model->select($list)->orderBy($order)->get($list);
        return $model->toJson(JSON_HEX_APOS);
    }

    public function delete($id)
    {
        try {
            $model = $this->findById($id);
            $model->delete();
        } catch (\Exception $e) {
        }
    }

    public function findById($id, $cols = array('*'))
    {
        return $this->model->findOrFail($id, $cols);
    }

    public function findBy($where, $value, $cols = array('*'))
    {
        return $this->model->where($where, $value)->get($cols);
    }


    public function findInRecentOrder($where, $value, $cols = array('*'))
    {
        return $this->model->where($where, $value)->orderBy('created_at', 'desc')->get($cols);
    }


    public function findAndOrderByCol($where, $value, $cols = array('*'), $by = "name")
    {
        return $this->model->where($where, $value)->orderBy($by, 'asc')->get($cols);
    }

    public function findBySingle($where, $value)
    {
        return $this->model->where($where, $value)->firstOrFail();
    }

    public function findByWhere($where, $cols = array('*'))
    {
        return $this->model->where($where)->get($cols);
    }

    public function findBySearch($data, $cols = array('*'))
    {
        $model = $this->model;
        return $model->get($cols);
    }

    public function findByIdWith($id, $cols = array('*'), $with = [])
    {
        return $this->model->with($with)->findOrFail($id, $cols);
    }

    public function findByWith($where, $value, $with, $cols = array('*'))
    {
        return $this->model->where($where, $value)->with($with)->get($cols);
    }


    public function getAllBySearchQuery($query, $search_column = 'name')
    {
        $query = trim(strtolower($query));
        $get = $this->model
            ->select([$search_column, 'id'])
            ->whereRaw("lower(" . $search_column . ") like q'[%" . $query . "%]' ")
            /*->orWhereRaw("lower(".$search_column.") like '%\_".$query."%' ESCAPE '\' ")*/
            ->get();

        $model = [];
        foreach ($get as $g) {
            $model['suggestions'][] = ['value' => $g->$search_column, 'data' => $g->id];
        }

        if (!count($model)) $model['suggestions'] = [];

        return $model;
    }





}
