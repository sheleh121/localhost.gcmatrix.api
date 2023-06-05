<?php

namespace App\Http;

class QueryFilter
{
    protected $builder;
    protected $request;

    public function __construct($builder, $request)
    {
        $this->builder = $builder;
        $this->request = $request;
    }

    public array $filters = [
        'id',
        'name'
    ];

    public function apply()
    {
        foreach ($this->filters() as $filter => $value) {
            if (isset($value) && in_array($filter, $this->filters)) {
                if (method_exists($this, $filter)) {
                    $this->$filter($value);
                } else {
                    $this->builder->where($filter, 'LIKE', $value . '%');
                }
            }
        }

        return $this->builder;
    }

    private function filters()
    {
        return $this->request->all();
    }

}
