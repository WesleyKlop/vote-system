<?php

declare(strict_types=1);

use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (\Symplify\EasyCodingStandard\Config\ECSConfig $config): void {
    $config->paths([
        __DIR__ . '/app',
        __DIR__ . '/config',
        __DIR__ . '/database/seeders',
        __DIR__ . '/database/factories',
        __DIR__ . '/resources/lang',
        __DIR__ . '/routes',
        __DIR__ . '/tests',
        __DIR__ . '/ecs.php',
        __DIR__ . '/rector.php',
    ]);

    $config->sets([SetList::PSR_12, SetList::CLEAN_CODE]);
};
