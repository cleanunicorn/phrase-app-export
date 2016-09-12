<?php

namespace Hydrarulz\PhraseAppExport\Commands;

use Hydrarulz\PhraseAppExport\Commands\InterogatorCommand;

class PhraseAppExportDownload extends InterogatorCommand
{
    /**
     * The command to download the language files and save them in the resource folder
     *
     * @var string
     */
    protected $signature = 'phraseapp:download';

    /**
     * Description for this command
     *
     * @var string
     */
    protected $description = 'Import the Phrase App files.';

    /**
     * Use the provided data to save it in the language file for the provided language
     *
     * @param  string $lang        The 2 letter language identified (en/ro/it/...)
     * @param  strign $fileContent The actual contents of the exported language from Phrase App
     *
     * @return integer             Number of bytes written
     */
    private function writeLanguageFile($lang, $fileContent)
    {
        $filePath = resource_path().'/lang/'.$lang.'/'.config('phrase-app-export.locales.file_name');
        return file_put_contents($filePath, $fileContent);
    }

    /**
     * Get the languages defined in the config file, download them and save them
     * in the resource path
     *
     * @return integer          How many languages were saved
     */
    public function handle()
    {
        $languages = config('phrase-app-export.locales.languages');
        $projectId = config('phrase-app-export.locales.project_id');

        foreach ($languages as $lang => $languageId) {
            $file = $this->getLanguage($projectId, $languageId);
            $this->writeLanguageFile($lang, $file);
        }

        return count($languages);
    }
}
