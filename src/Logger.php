<?php

namespace Forge\CLI;

use Monolog\Logger as MonologLogger;
use Monolog\Handler\StreamHandler;

class Logger
{
    protected MonologLogger $logger;

    public function __construct()
    {
        $this->logger = new MonologLogger('forge');
        $this->logger->pushHandler(new StreamHandler(__DIR__ . '/logs/forge.log', MonologLogger::DEBUG));
    }

    public function log(string $level, string $message): void
    {
        // Mise en gras si le texte le nécessite
        $message = $this->bold($message);

        // Log selon le niveau fourni
        switch (strtolower($level)) {
            case 'info':
                $this->logger->info($message);
                break;
            case 'warning':
                $this->logger->warning($message);
                break;
            case 'error':
                $this->logger->error($message);
                break;
            case 'success':
                // Pour success, utiliser info mais en ajoutant un préfixe ou un format spécifique
                $this->logger->info("[SUCCESS] " . $message);
                break;
            default:
                $this->logger->debug($message);
        }
    }

    // Fonction pour appliquer le format de texte en gras
    private function bold(string $message): string
    {
        // Pour les consoles qui supportent les codes ANSI
        // Exemple pour console (si votre environnement CLI le supporte) :
        // Si vous voulez que ce soit en gras dans une interface console compatible ANSI
        return "\033[1m" . $message . "\033[0m"; // Code ANSI pour le texte en gras

        // Si vous souhaitez un format Markdown pour une sortie dans un fichier ou une interface web :
        // return "**" . $message . "**"; // Graser en Markdown
    }
}
