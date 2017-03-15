<?php

namespace TemplateGen\Commands;

class Generate extends Command
{

    protected function configure()
    {
        $this
            ->setName('generate')
            ->setDescription('Generate templates');
    }

    protected function fire()
    {
        if (!$this->checkConfigFile()) {
            $this->error("No has inicializado el archivo de configuración. Ejecuta el comando init");
            return;
        }

        foreach ($this->config['groups'] as $group) {
            $this->comment($group['title']);
            $choice = $this->choiceQuestion("¿Quieres generar este grupo?", ["Si", "No"]);
            if ($choice == "No") {
                continue;
            }

            foreach ($group['templates'] as $template) {
                $srcs = $template['srcs'];
                $dest = $template['dest'];

                if (count($srcs) != count($dest)) {
                    $this->error("Tienen que existir las mismas srcs que dest");
                    continue;
                }

                if ($file = $this->checkExist($srcs)) {
                    $this->error("El template $file no existe");
                    continue;
                }

                $replaces = [];
                foreach ($template['questions'] as $key => $question) {
                    $replace = $this->question($question['title'] . "\n");
                    $replaces[] = [
                        'replace'  => $replace,
                        'replaces' => $question['replaces']
                    ];
                }

                foreach ($srcs as $n => $src) {
                    $file = file_get_contents($this->getFile($src));

                    $file = $this->replace($file, $replaces);

                    $desttemplate = $this->replace($dest[$n], $replaces);

                    $file_dest = $this->dir_root() . '/' . $desttemplate;
                    $dir = dirname($file_dest);

                    if (!is_dir($dir)) {
                        mkdir($dir, 0777, true);
                    }
                    file_put_contents($file_dest, $file);
                    $this->comment("Template $desttemplate generado correctamente.");
                }

            }
        }

    }

    protected function replace($string, $replaces)
    {
        foreach ($replaces as $replace) {
            $string_replace = $replace['replace'];
            foreach ($replace['replaces'] as $_replace) {
                if (!is_array($_replace)) {
                    $string = str_replace($_replace, $string_replace, $string);
                } else {
                    foreach ($_replace as $name => $options) {
                        $string = str_replace($name, $this->parseReplace($string_replace, $options), $string);
                    }
                }
            }
        }

        return $string;
    }

    protected function parseReplace($string, $options)
    {
        foreach ($options as $opt) {
            $option = key($opt);
            $value = $opt[$option];

            if ($option == 'prefix') {
                $string = $value . $string;
            }
            if ($option == 'suffix') {
                $string = $string . $value;
            }
            if ($option == 'uppercase') {
                $string = strtoupper($string);
            }
            if ($option == 'lowercase') {
                $string = strtolower($string);
            }
        }

        return $string;
    }

    protected function checkExist($templates)
    {
        foreach ($templates as $template) {
            if (!$file = $this->getFile($template)) {
                return $template;
            }
        }

        return false;
    }

}