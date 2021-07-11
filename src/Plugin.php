<?php

namespace UMA\Composer\PsySH;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\Capability\CommandProvider;
use Composer\Plugin\Capable;
use Composer\Plugin\PluginInterface;

final class Plugin implements Capable, CommandProvider, PluginInterface
{
    /** @var string[] */
    private static $autoloadScripts;

    public function activate(Composer $composer, IOInterface $io)
    {
        self::$autoloadScripts = [$composer->getConfig()->get('home') . '/vendor/autoload.php'];

        if (\file_exists($localProjectAutoload = getcwd() . '/vendor/autoload.php')) {
            self::$autoloadScripts[] = $localProjectAutoload;
        }
    }

    public function deactivate(Composer $composer, IOInterface $io)
    {
    }

    public function uninstall(Composer $composer, IOInterface $io)
    {
    }

    public function getCapabilities()
    {
        return [CommandProvider::class => self::class];
    }

    public function getCommands()
    {
        return [new Launcher(self::$autoloadScripts)];
    }
}
