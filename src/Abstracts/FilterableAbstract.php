<?php

namespace TheJano\LaravelFilterable\Abstracts;

use Illuminate\Database\Eloquent\Builder;

abstract class FilterableAbstract
{
    private mixed $request;
    protected array $filters = [];

    public function __construct()
    {
        $this->request = request();
    }

    public function filter(Builder $builder): Builder
    {
        foreach ($this->getFilters() as $filter => $value) {
            (new $this->filters[$filter]())->handle($builder, $value);
        }

        return $builder;
    }

    protected function getFilters(): array
    {
        return array_filter($this->request->only(array_keys($this->filters)));
    }

    public function add(array $filters): self
    {
        $this->filters = array_merge($this->filters, $filters);

        return $this;
    }
}
