<?php

namespace TheJano\LaravelFilterable\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use TheJano\LaravelFilterable\Traits\HasFilterableTrait;

class Category extends Model
{
    use HasFilterableTrait;

    protected $guarded = [];
}
