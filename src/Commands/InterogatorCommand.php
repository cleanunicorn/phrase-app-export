<?php

namespace Hydrarulz\PhraseAppExport\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use GuzzleHttp\Client;

abstract class InterogatorCommand extends Command
{
    /**
     * @param \Symfony\Component\Console\Input\InputInterface   $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return int
     */
    public function run(InputInterface $input, OutputInterface $output)
    {
        return parent::run($input, $output);
    }

    /**
     * Get the language file and return it as a string
     *
     * @param  integer $projectId  The project id (retrieved from Phrase App)
     * @param  integer $languageId The language id (retrieved from Phrase App)
     *
     * @return string             The contents of the language file
     */
    public function getLanguage($projectId, $languageId)
    {
        $client = new Client([
            'base_uri' => 'https://api.phraseapp.com/api/v2/',
            'timeout' => 5.0,
            'headers' => [
                'User-Agent' => 'Phrase App Export for Laravel (daniel@elasticorange.com)',
                'Authorization' => 'token '.env('PHRASE_APP_EXPORT_API_KEY'),
            ],
        ]);

        $this->info('Downloading language id '.$languageId.' for project id '.$projectId);

        $response = $client->request(
            'GET',
            'projects/'.$projectId.'/locales/'.$languageId.'/download',
            [
                'form_params' => [
                    'file_format' => config('phrase-app-export.locales.format'),
                ],
            ]
        );

        $this->info('Done '.strlen($response->getBody()).' bytes');

        if ($response->getStatusCode() == 200) {
            return $response->getBody();
        } else {
            return false;
        }
    }
}
