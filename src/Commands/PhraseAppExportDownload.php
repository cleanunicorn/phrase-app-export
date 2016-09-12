<?php

namespace Hydrarulz\PhraseAppExport\Commands;

use Hydrarulz\PhraseAppExport\Commands\InterogatorCommand;

class PhraseAppExportDownload extends InterogatorCommand
{
    protected $signature = 'phraseapp:download';

    protected $description = 'Import the Phrase App files.';

    public function handle()
    {
        $files = $this->export();
    }
}
