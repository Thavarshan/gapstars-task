<?php

namespace App\Models;

use Filterable\Interfaces\Filterable;
use Filterable\Traits\Filterable as HasFilters;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model implements Filterable
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory, HasFilters;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'title',
        'description',
    ];
}
