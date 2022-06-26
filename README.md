
# Laravel Filterable

[![Latest Version on Packagist](https://img.shields.io/packagist/v/thejano/laravel-filterable.svg?style=flat-square)](https://packagist.org/packages/thejano/laravel-filterable)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/thejano/laravel-filterable/run-tests?label=tests)](https://github.com/thejano/laravel-filterable/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/thejano/laravel-filterable/Check%20&%20fix%20styling?label=code%20style)](https://github.com/thejano/laravel-filterable/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/thejano/laravel-filterable.svg?style=flat-square)](https://packagist.org/packages/thejano/laravel-filterable)

This package adds filtration functionality to Laravel Models. It would be based on Filterable and Query Filter classes. 
The package will provide commands to generate Filterable and Query Filter classes. By default, it will add some default filtration out of the box to you models like ordering, get data between tow dates and more. 

Imagine you have a url containing the following parameters:

```bash
/posts?slug=the-new-web&published=true&category=web-development&tags[]=web&tags[]=laravel&tags[]=flutter
```

Laravel request all method `request()->all()` will return something like this:
```php
[
    "slug"        => "the-new-web",
    "published"   => "true",
    "category"    => "web-development",
    "tags"        => [ "web", "laravel", "flutter"],
]
```

Normally, you should do the logic one by one to perform the filtration 

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::query();

        if ($request->has('title'))
        {
            $query->where('title', 'LIKE', '%' . $request->input('title') . '%');
        }
       
       if ($request->has('published'))
        {
            $query->where('published', (bool) $request->input('published'));
        }

        if ($request->has('category')){
            $query->whereHas('category', function ($query) use ($request)
            {
                return $query->where('category_slug', $request->input('category'));
            });
        }
        
        if ($request->has('tags')){
            $query->whereHas('tag', function ($query) use ($request)
            {
                return $query->where('tag_slug', $request->input('tags'));
            });
        }
        $posts = $query->get();
        return view('posts',compact('posts'));
    }

}
```

For simple queries, it would be fine, but when you have a bunch of filters, you can not control them and none of them are reusable.


With this package you need to only pass `filterable()` scope method to your model before returning the records, check below example:
```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::filterable()->get();
        return view('posts',compact('posts'));
    }

}
```


## Requirement

The package requires:
- PHP 8.0 or higher
- Laravel 9.x


## Installation

You can install the package via composer:

```bash
composer require thejano/laravel-filterable
```


You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-filterable-config"
```

## Usage

To add the magic you should add only `hasFilterableTrait` to your model.

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TheJano\LaravelFilterable\Traits\HasFilterableTrait;

class Post extends Model
{
    use HasFactory;
    use HasFilterableTrait;
}

```

Then you need to create a FilterableClass and some Query Filters to define your rules. 

<br>

To remove the pain of creating the classes, already I added some commands.

- For creating a Filterable class, you need to run this command:
```bash
php artisan make:filterable PostsFilterable
```

 It would generate a class under `\App\Filters\Filterable\PostsFilterable` and it contains:
```php
<?php

namespace App\Filters\Filterable;

use TheJano\LaravelFilterable\Abstracts\FilterableAbstract;
use TheJano\LaravelFilterable\Interfaces\FilterableInterface;

class PostsFilterable extends FilterableAbstract implements FilterableInterface
{
    /**
     * It contains list of Query Filters
     *
     * @var Array
     */
    protected array $filters = [];
}
```
<br>

- And now let's create a Query Filter class:
```bash
php artisan make:query-filter PublishedQueryFilter
```
It would generate a class under `\App\Filters\QueryFilter\PublishedQueryFilter` and it contains:
```php
<?php

namespace App\Filters\QueryFilter;

use Illuminate\Database\Eloquent\Builder;
use TheJano\LaravelFilterable\Abstracts\QueryFilterAbstract;
use TheJano\LaravelFilterable\Interfaces\QueryFilterInterface;

class PublishedQueryFilter extends QueryFilterAbstract implements QueryFilterInterface
{
    /**
     * Can be used to map the values.
     * It can be returned through resolveValue method
     *
     * @var Array
    */
    protected array $mapValues = [];

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
        return $builder;
    }
}
```
 You will do the logic for each column inside each Query Filter separately. Let's implement the logic here
```php
public function handle(Builder $builder, $value): Builder
{
    return $builder->where('published', $value);
}
```
The returned value is a string, and it does not return any data. So we should map the value.

There is a property `$mapValues` inside the class. 
```php
protected array $mapValues = [
    'true' => true,
    'false' => false,
];
```
And finally, we should resolve the mapped value through `resolveValue()` method.
```php
protected array $mapValues = [
    'true' => true,
    'false' => false,
];

public function handle(Builder $builder, $value): Builder
{
    $value = $this->resolveValue($value);
    
    // return Builder if the value is null     
    if (is_null($value)) {
        return $builder;
    }

    return $builder->where('published', $value);
}
```

To make the Query Filter live, we should append it to the `$columns` property of `PostsFilterable` class.
```php
public array $filters = [
    'published' => 'App\\Filters\\QueryFilter\\PublishedQueryFilter',
];
```


<br>

- When we create a Query Filter directly you can pass the Filterable class as a parameter to auto-insert into`$filters` property.

```bash
php artisan make:query-filter PublishedQueryFilter --filterable=PostsFilterable
```

Now your `PostsFilterable` class should contain something like this:

```php
<?php

namespace App\Filters\Filterable;

use TheJano\LaravelFilterable\Abstracts\FilterableAbstract;
use TheJano\LaravelFilterable\Interfaces\FilterableInterface;

class PostsFilterable extends FilterableAbstract implements FilterableInterface
{
    /**
     * It contains list of Query Filters
     *
     * @var Array
     */
    public array $filters = [
        'published' => 'App\\Filters\\QueryFilter\\PublishedQueryFilter',
    ];
}
```

<br>

The final step is enabling `PostsFilterable` to your model. 

There are 2 ways to enable it:
1. Globally for the model, through returning the class path to `filterableClass()` method.
```php
<?php

namespace App\Models;

use App\Filters\Filterable\PostsFilterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TheJano\LaravelFilterable\Traits\HasFilterableTrait;

class Post extends Model
{
    use HasFactory;
    use HasFilterableTrait;

    /**
     * Enable the filterable class to the model globally
     *
     * @return void
     */
    public function filterableClass()
    {
        return PostsFilterable::class;
    }
}
```
<br>

2. Locally, through passing as a parameter to `fliterable()` scope of your model. The scope accepts 3 parameters
```php
public function scopeFilterable(Builder $builder, $request = null, $filterableClass = null, $filters = []): Builder
```
<br>

If you pass Filterable class as 1st parameter, under the hood the package will handle it for you and ignore the `request`. Let's check the code below.
```php
<?php

namespace App\Http\Controllers;

use App\Filters\Filterable\PostFilterable;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::filterable(PostFilterable::class)->get();
        return view('posts', compact('posts'));
    }
}

```
Also, you can pass some additional Query Filters through `$filters` parameter, for example:
```php
<?php

namespace App\Http\Controllers;

use App\Filters\Filterable\PostFilterable;
use App\Filters\QueryFilter\TitleQueryFilter;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::filterable(PostFilterable::class,[
            'title' => TitleQueryFilter::class
        ])->get();
        return view('posts', compact('posts'));
    }
}

```

## Default Query Filters 
Last but not least, by default the package deliveries some Query Filters with every Filterable class.
The configuration file contains the available Query Filters, which are:

<br>

1. `date` query filter, it returns records between 2 dates (from and to). By default, it uses `created_at` field.
```bash
/posts?date[from]=2022-06-01&date[to]=2022-07-01
```
Or you can pass a custom field. The delimiter is `BY`
```bash
/posts?date[fromBYupdated_at]=2022-06-01&date[toInBupdated_at]=2022-07-01
```
<br>

2. `order` query filter, it orders the records as ASC or DESC. By default, it uses `created_at` field.
```bash
/posts?order=asc
```
Or you can pass a custom field. 
```bash
/posts?order[id]=asc
```






## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Dr Pshtiwan](https://github.com/drpshtiwan)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
