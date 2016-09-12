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
        $this->publishes([
            __DIR__.'/../config/phrase-app-export.php' => config_path('phrase-app-export.php'),
        ], 'config');
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
