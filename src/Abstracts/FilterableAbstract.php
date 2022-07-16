<?php

namespace TheJano\LaravelFilterable\Abstracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use TheJano\LaravelFilterable\QueryFilter\DefaultFilters;

abstract class FilterableAbstract
{
    private mixed $request;

    protected array $filters = [];

    public function __construct($request = null)
    {
        $this->request = $request;

        if (null === $request) {
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
        return null !== $this->cleanRequest() ?
                array_filter($this->cleanRequest(), static fn ($filter) => null !== $filter)
                : [];
    }

    public function cleanRequest(): array
    {
        if ($this->request instanceof Request) {
            return $this->request->only(array_keys($this->filters));
        }

        return collect($this->request)->only(array_keys($this->filters))->toArray();
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
