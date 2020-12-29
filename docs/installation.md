### Installation via [Composer](https://getcomposer.org)
If Composer is installed globally:  
```
composer require skrtdev/novagram
```

If Composer is installed in the current directory:
```
php composer.phar require skrtdev/novagram
```

After Installation, include NovaGram with:  
```php
require __DIR__ . '/vendor/autoload.php';
```

### Installation via Phar
Automatically download and require the `Phar` file.  
If you want to update NovaGram, just delete the `Phar` file, it is generated from the `master` branch.  
```php
if (!file_exists('novagram.phar')) {
    copy('https://novagram.ga/phar', 'novagram.phar');
}
require_once 'novagram.phar';
```

[How to create a Bot Instance](construct.md)
