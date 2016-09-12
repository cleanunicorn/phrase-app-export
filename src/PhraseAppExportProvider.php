<?php

namespace Hydrarulz\PhraseAppExport;

use Illuminate\Support\ServiceProvider;
use Hydrarulz\PhraseAppExport\Commands\PhraseAppExportDownload;

class PhraseAppExportProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('command.phraseapp:download', PhraseAppExportDownload::class);

        $this->commands([
            'command.phraseapp:download',
        ]);
    }
}
