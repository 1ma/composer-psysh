<?php

declare(strict_types=1);

namespace UMA\Composer\PsySH\Launcher;

use Composer\Command\BaseCommand;
use Composer\Config;
use Psy\Configuration;
use Psy\Shell;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Launcher class for symfony/console 7.x
 */
final class Transitional extends BaseCommand
{
    /** @var string[] */
    private array $autoloadScripts;
    private Configuration $configuration;

    public function __construct(string ...$autoloadScripts)
    {
        $this->autoloadScripts = $autoloadScripts;
        $this->configuration = new Configuration([
            'startupMessage' => self::startupMessage(...$autoloadScripts)
        ]);

        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('psy')
            ->setAliases(['repl', 'shell'])
            ->setDescription('Psy Shell with autoload integration');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        Config::disableProcessTimeout();

        foreach ($this->autoloadScripts as $autoloadScript) {
            require $autoloadScript;
        }

        return (new Shell($this->configuration))->run();
    }

    private static function startupMessage(string ...$autoloadScripts): string
    {
        $message = 'Active Autoloaders:' . PHP_EOL;
        foreach ($autoloadScripts as $autoloadScript) {
            $message .= '  ' . $autoloadScript . PHP_EOL;
        }

        return $message;
    }
}
