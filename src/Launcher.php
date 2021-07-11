<?php

namespace UMA\Composer\PsySH;

use Composer\Command\BaseCommand;
use Composer\Config;
use Psy\Shell;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class Launcher extends BaseCommand
{
    /** @var string[] */
    private $autoloadScripts;

    /**
     * @param string[] $autoloadScripts
     */
    public function __construct($autoloadScripts)
    {
        $this->autoloadScripts = $autoloadScripts;
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

        return (new Shell())->run();
    }
}
