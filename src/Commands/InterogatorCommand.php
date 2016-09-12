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
            // Base URI is used with relative requests
            'base_uri' => 'https://api.phraseapp.com/api/v2/',
            // You can set any number of default request options.
            'timeout' => 5.0,
            // Headers
            'headers' => [
                'User-Agent' => 'Phrase App Export for Laravel (daniel@elasticorange.com)',
                'Authorization' => 'token afa8ee1197dd7ad088c4601344410c05fe4d683e48fda8816fe2b7c7877ee43a',
            ],
        ]);

        $this->info('Downloading language id '.$languageId.' for project id '.$projectId);

        $response = $client->request(
            'GET',
            'projects/b6a403bd473fe4ce00e27045db550f38/locales/4c67a1609adcfabe166be9fad2b04ef4/download',
            [
                'form_params' => [
                    'file_format' => 'laravel',
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
