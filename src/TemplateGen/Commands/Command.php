<?php

namespace TemplateGen\Commands;

use Symfony\Component\Yaml\Yaml;

class Command extends AbstractCommand
{

    /**
     * @var string
     */
    protected $config_file_name = 'generatetemplates.yml';

    /**
     * @var array
     */
    protected $config = [];

    protected function dir_root()
    {
        return realpath(getcwd());
    }

    protected function checkConfigFile()
    {
        $file = $this->getConfigFile();
        if (file_exists($file)) {
            $this->config = Yaml::parse(file_get_contents($file));
            return $file;
        }
        return false;
    }

    protected function getConfigFile()
    {
        return $this->dir_root() . '/' . $this->config_file_name;
    }

    protected function getConfigDefault()
    {
        return __DIR__ . '/../../app/generatetemplates.yml';
    }


    protected function getFile($name)
    {
        $file = $this->dir_root() . '/' . $name;
        if (!file_exists($file)) {
            return false;
        }

        return $file;
    }

    protected function fire()
    {

    }


}