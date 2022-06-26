<?php

namespace App\Filters\Abstracts;

use Illuminate\Database\Eloquent\Builder;

abstract class FilterableAbstract
{
    public $request;
    protected $filters = [];

    public function __construct()
    {
        $this->request = request();
    }

    public function filter(Builder $builder)
    {
        foreach ($this->getFilters() as $filter => $value) {
            (new $this->filters[$filter]())->handle($builder, $value);
        }

        return $builder;
    }

    protected function getFilters()
    {
        return array_filter($this->request->only(array_keys($this->filters)));
    }

    public function add(array $filters)
    {
        $this->filters = array_merge($this->filters, $filters);
        return $this;
    }
}
