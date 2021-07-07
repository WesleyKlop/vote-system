<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\EasyCodingStandard\ValueObject\Option;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();

    $parameters->set(Option::PATHS, [
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

    $containerConfigurator->import(SetList::PSR_12);
    $containerConfigurator->import(SetList::CLEAN_CODE);
};
