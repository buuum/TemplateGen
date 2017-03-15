<?php

namespace TemplateGen;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TemplateGen\Commands\Generate;
use TemplateGen\Commands\Init;

class TemplateGen extends Application
{

    protected $config_file;

    public function __construct($version = '1.0.0')
    {
        parent::__construct("TemplateGen: Generate templates project.", $version);

        $this->addCommands([
            new Init(),
            new Generate()
        ]);
    }

    public function doRun(InputInterface $input, OutputInterface $output)
    {
        // always show the version information except when the user invokes the help
        // command as that already does it
        if (false === $input->hasParameterOption(array('--help', '-h')) && null !== $input->getFirstArgument()) {
            $output->writeln($this->getLongVersion());
            $output->writeln('');
        }

        return parent::doRun($input, $output);
    }

}
