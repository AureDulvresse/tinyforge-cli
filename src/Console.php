<?php

namespace Forge\CLI;

use Symfony\Component\Console\Application;
use Forge\CLI\Commands\ServeCommand;
use Forge\CLI\Commands\MigrateCommand;

class Console
{
    public function __construct()
    {
        // Application Console de Symfony
        $application = new Application();

        // Enregistrer les commandes
        $application->add(new ServeCommand());
        $application->add(new MigrateCommand());

        // Exécution des commandes
        $application->run();
    }
}
