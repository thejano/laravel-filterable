<?php

namespace TheJano\LaravelFilterable\Abstracts;

use Illuminate\Database\Eloquent\Builder;
use TheJano\LaravelFilterable\QueryFilter\DefaultFilters;

abstract class FilterableAbstract
{
    private mixed $request;
    protected array $filters = [];

    public function __construct($request = null)
    {
        $this->request = $request;

        if (is_null($request)) {
            $this->request = request();
        }

        $this->seDefaultFilters();
    }

    protected function seDefaultFilters(): void
    {
        $this->filters = array_merge(DefaultFilters::list(), $this->filters);
    }

    protected function appliedFilters(): array
    {
        $clean_request = $this->request->only(array_keys($this->filters));

        return ! is_null($clean_request) ? array_filter($clean_request) : [];
    }

    public function filter(Builder $builder): Builder
    {
        foreach ($this->appliedFilters() as $filter => $value) {
            (new $this->filters[$filter]())->handle($builder, $value);
        }

        return $builder;
    }

    public function add(array $filters): self
    {
        $this->filters = array_merge($this->filters, $filters);

        return $this;
    }
}
