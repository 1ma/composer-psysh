<?php

declare(strict_types=1);

use Composer\InstalledVersions;
use UMA\Composer\PsySH\Launcher;

if (\version_compare(InstalledVersions::getVersion('symfony/console'), '7.0.0', '<')) {
    \class_alias(Launcher\Legacy::class, Launcher::class);
    return;
}

if (\version_compare(InstalledVersions::getVersion('symfony/console'), '8.0.0', '<')) {
    \class_alias(Launcher\Transitional::class, Launcher::class);
    return;
}

\class_alias(Launcher\FullyTyped::class, Launcher::class);
