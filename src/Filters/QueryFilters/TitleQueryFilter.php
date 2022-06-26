<?php

namespace App\Filters\QueryFilters;

use App\Filters\Abstracts\QueryFilterAbstract;
use App\Filters\Interfaces\QueryFilterInterface;
use Illuminate\Database\Eloquent\Builder;

class TitleQueryFilter extends QueryFilterAbstract implements QueryFilterInterface
{
    /**
     * Can be used to map the values.
     * It can be returned through resolveValue method
     *
     * @var Array
    */
    protected $mapValues = [
        'true' => true,
        'false' => false
    ];

    /**
     * Handle The Query Filter
     *
     *
     * @param Builder $builder Query Builder
     * @param string $value
     * @return Builder
     **/
    public function handle(Builder $builder, $value): Builder
    {
        return $builder->like('title', $value);
    }
}
