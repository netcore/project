Netcore Development Helpers
----

#### Installation:

1. Run <br> 
```bash 
composer require netcore/project --dev
```

2. Add service provider to your app.php configuration file <br>
```php
'providers' => [
    ...
    Netcore\Project\ProjectServiceProvider::class,
]
```

3. You can also publish the config file to change implementations (ie. files to remove, turn off cache clear etc.)
```bash
php artisan vendor:publish --provider="Netcore\Project\ProjectServiceProvider" --tag=config
```

### Usage
- TODO

