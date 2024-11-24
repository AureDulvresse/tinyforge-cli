<?php

namespace Forge\CLI\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ServeCommand extends Command
{
    protected function configure()
    {
        $this->setName('serve')
            ->setDescription('Lance le serveur PHP');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        // Logique pour démarrer le serveur
        $io->title('Démarrage du serveur PHP');
        $io->text('Lancement du serveur PHP sur 127.0.0.1:8000...');

        // Commande pour démarrer le serveur PHP
        $command = 'php -S 127.0.0.1:8000 -t public'; // Modifie le chemin si nécessaire
        $process = proc_open($command, [
            1 => ["pipe", "w"], // Output du processus
            2 => ["pipe", "w"], // Erreurs du processus
        ], $pipes);

        if (is_resource($process)) {
            $io->success('Le serveur a démarré avec succès.');

            // Lire les logs du serveur et les afficher en temps réel
            while ($line = fgets($pipes[1])) {
                $io->writeln("<fg=green>$line</>");
            }

            fclose($pipes[1]);
            fclose($pipes[2]);

            // Garde le serveur actif
            proc_close($process);

            return Command::SUCCESS;
        }

        $io->error('Erreur lors du démarrage du serveur.');
        return Command::FAILURE;
    }
}
