<?php

namespace TheJano\LaravelFilterable\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use TheJano\LaravelFilterable\Tests\Filters\Filterable\PostFilterable;
use TheJano\LaravelFilterable\Traits\HasFilterableTrait;

class Category extends Model
{
    use HasFilterableTrait;

    protected $guarded = [];
}
