<?php

namespace Forge\CLI\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MigrateCommand extends Command
{
    protected function configure()
    {
        $this->setName('migrate') // Définir un nom pour la commande
            ->setDescription('Effectue les migrations de la base de données');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Logique pour effectuer les migrations ici

        $output->writeln('Migration effectuée avec succès.');

        // Retourne le code de succès
        return Command::SUCCESS;
    }
}
