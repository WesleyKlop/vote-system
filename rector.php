<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\SetList;

return static function (RectorConfig $config): void {
    $config->sets([
        SetList::PHP_80,
        SetList::PHP_81,
    ]);

    $config->paths([
        __DIR__ . '/app',
        __DIR__ . '/bootstrap/app.php',
        __DIR__ . '/config',
        __DIR__ . '/database/seeders',
        __DIR__ . '/database/factories',
        __DIR__ . '/public/index.php',
        __DIR__ . '/resources/lang',
        __DIR__ . '/routes',
        __DIR__ . '/tests',
        __DIR__ . '/ecs.php',
        __DIR__ . '/rector.php',
    ]);
};
