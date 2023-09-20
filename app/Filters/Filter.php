<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class Filter
{
    /**
     * @var Request
     */
    protected $request;
    /**
     * The Eloquent builder.
     *
     * @var Builder
     */
    protected $builder;
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = [];
    private $passedFilters;

    /**
     * Create a new ThreadFilters instance.
     *
     * @param $filters
     */
    public function __construct($filters)
    {
        $this->passedFilters = $filters;
    }

    /**
     * Apply the filters.
     *
     * @param Builder $builder
     * @return Builder
     */
    public function apply($builder)
    {
        $this->builder = $builder;
        foreach ($this->getFilters() as $filter => $value) {
            if (method_exists($this, $filter)) {
                $this->$filter($value);
            }
        }
        return $this->builder;
    }

    /**
     * Fetch all relevant filters from the request.
     *
     * @return array
     */
    public function getFilters()
    {
        return array_intersect_key($this->passedFilters, array_flip($this->filters));
    }

    /**
     * @param $filters
     */
    public function setFilters($filters)
    {
        $this->filters = $filters;
    }
}
