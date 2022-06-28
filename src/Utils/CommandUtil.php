<?php

namespace TheJano\LaravelFilterable\Utils;

use Archetype\Facades\PHPFile;

class CommandUtil
{
    public static function getNewFilter($queryFilter): array
    {
        $key = self::getFilterKey($queryFilter);

        return [
            $key => $queryFilter->namespace,
        ];
    }

    public static function appendNewFilterTo($filterable, $newFilter): void
    {
        $filterableFile = PHPFile::load($filterable->namespace);

        $filters = $filterableFile->property('filters') ?? [];
        $filters = array_merge($filters, $newFilter);

        $filterableFile->setProperty('filters', $filters)->save();
    }

    public function initializeClass($name, $configKey): object
    {
        if (is_null($name)) {
            return (object) [
              'name' => $name,
            ];
        }

        $namespaceKey = $configKey.'_namespace';
        $suffixKey = $this->getConfig($configKey.'_suffix');

        return (object) [
            'name' => $name,
            'namespace_key' => $namespaceKey,
            'namespace' => $this->getClassNamespace($name, $namespaceKey),
            'path' => $this->getClassPath($name, $namespaceKey),
            'suffix' => $suffixKey,
        ];
    }

    public static function getFilterKey($class)
    {
        $className = str()->of($class->name)->explode('\\')->last();

        return str()->of($className)->replace($class->suffix, '')->camel()->value;
    }

    public function getClassPath(string $className, string $configKey): string
    {
        $config = $this->getConfig($configKey);

        $folderPath = str()->of($config)->explode('\\')->forget(0)->join('/');
        $class = str_replace('\\', '/', $className);

        return app_path("{$folderPath}/{$class}.php");
    }

    public function getClassNamespace($className, $configKey): string
    {
        $config = $this->getConfig($configKey);

        return "{$config}\\{$className}";
    }

    public function getConfig($key): string
    {
        return config('filterable.'.$key);
    }
}
