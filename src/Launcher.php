<?php

namespace UMA\Composer\PsySH;

use Composer\Command\BaseCommand;
use Composer\Config;
use Psy\Configuration;
use Psy\Shell;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class Launcher extends BaseCommand
{
    /**
     * @var string[]
     */
    private $autoloadScripts;

    /**
     * @var Configuration
     */
    private $configuration;

    /**
     * @param string[] $autoloadScripts
     */
    public function __construct(array $autoloadScripts)
    {
        $this->autoloadScripts = $autoloadScripts;
        $this->configuration = new Configuration([
            'startupMessage' => self::startupMessage($autoloadScripts)
        ]);

        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('psy')
            ->setAliases(['repl', 'shell'])
            ->setDescription('Psy Shell with autoload integration');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        Config::disableProcessTimeout();

        foreach ($this->autoloadScripts as $autoloadScript) {
            require $autoloadScript;
        }

        return (new Shell($this->configuration))->run();
    }

    private static function startupMessage(array $autoloadScripts)
    {
        $message = "Active Autoloaders:\n";
        foreach ($autoloadScripts as $autoloadScript) {
            $message .= "  $autoloadScript\n";
        }

        return $message;
    }
}
