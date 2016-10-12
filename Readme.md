# An easy way to download PhraseApp language files for Laravel

This Laravel package uses the API that PhraseApp provides to download the
Laravel export format.

After you install it just run

```bash
php artisan phraseapp:download
```

And you will see output similar to this
```
Downloading language id abcdefghijklmnopqrtstuv123456789 for project id abcdefghijklmnopqrtstuv123456789
Done 74833 bytes
```

## Installation
First add the package to your Laravel app

```bash
composer require hydrarulz/phrase-app-export
```

You need to register the service provider.
Add this line to your `config/app.php` **providers** array

```php
'providers' => [
    // ...
    Hydrarulz\PhraseAppExport\PhraseAppExportProvider::class,
];
```

Next you need to publish the config file

```bash
php artisan vendor:publish --provider="Hydrarulz\PhraseAppExport\PhraseAppExportProvider"
```

A new file was published in your config directory; now edit the file `/config/phrase-app-export.php`

```php

return [
    'locales' => [
        'project_id' => '', // Get the project id from Phrase App
        'languages' => [
            'en' => '', // Get the locale id for this language from Phrase App
            'ro' => '', // You can specify multiple languages
        ],
        'format' => 'laravel',
        'file_name' => 'messages.php', // This will create a filename (i.e /resources/lang/en/messages.php)
    ]
];

```

Get the **project_id** and **language['en']** id from your PhraseApp account. Feel free to add more languages or use only those that you need.

The default language file has 2 languages specified, just add others next to these ones.

After all was set you can just run

```bash
php artisan phraseapp:download
```

If you get an error like
```
Client error: `GET https://api.phraseapp.com/api/v2/projects//locales//download` resulted in a `404 Not Found` response
```
It means you did not change the config file.
