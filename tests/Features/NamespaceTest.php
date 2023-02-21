<?php

use Illuminate\Support\Facades\Artisan;

function deleteDirectory($dir)
{
    if (! file_exists($dir)) {
        return true;
    }

    if (! is_dir($dir)) {
        return unlink($dir);
    }

    foreach (scandir($dir) as $item) {
        if ('.' === $item || '..' === $item) {
            continue;
        }

        if (! deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }
    }

    return rmdir($dir);
}

it('Provide custom namespace for filterable. ', function () {
    Artisan::call('make:filterable', [
        'name' => 'PostsFilterable',
        '--namespace' => 'App\\CustomFilters\\Filterable',
    ]);

    $dirPath = base_path('app/CustomFilters');
    $fileExists = file_exists("{$dirPath}/Filterable/PostsFilterable.php");

    deleteDirectory($dirPath);

    $this->assertTrue($fileExists);
});

it('Provide custom namespace for query filter . ', function () {
    Artisan::call('make:query-filter', [
        'name' => 'DateQuery',
        '--namespace' => 'App\\CustomFilters\\Query',
    ]);

    $dirPath = base_path('app/CustomFilters');
    $fileExists = file_exists("{$dirPath}/Query/DateQuery.php");

    deleteDirectory($dirPath);

    $this->assertTrue($fileExists);
});
