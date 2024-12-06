<?php

namespace App\Filters;

use Filterable\Filter;
use Illuminate\Database\Eloquent\Builder;

class TaskFilter extends Filter
{
    /**
     * Registered filters to operate upon.
     *
     * @var array<string>
     */
    protected array $filters = ['title'];

    /**
     * Filter the query by a given title value.
     */
    protected function title(string $value): Builder
    {
        return $this->builder->where('title', $value);
    }
}
