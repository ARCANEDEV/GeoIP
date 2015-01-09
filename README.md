GeoIP for Laravel
==============
[![Travis Status](http://img.shields.io/travis/ARCANEDEV/GeoIP.svg?style=flat-square)](https://travis-ci.org/ARCANEDEV/GeoIP)
[![Coverage Status](http://img.shields.io/coveralls/ARCANEDEV/GeoIP.svg?style=flat-square)](https://coveralls.io/r/ARCANEDEV/GeoIP?branch=master)
[![Github Release](http://img.shields.io/github/release/ARCANEDEV/GeoIP.svg?style=flat-square)](https://github.com/ARCANEDEV/GeoIP/releases)
[![Packagist License](http://img.shields.io/packagist/l/arcanedev/geo-ip.svg?style=flat-square)](https://github.com/ARCANEDEV/GeoIP/blob/master/LICENSE)
[![Packagist Downloads](https://img.shields.io/packagist/dt/arcanedev/geo-ip.svg?style=flat-square)](https://packagist.org/packages/arcanedev/geo-ip)
[![Github Issues](http://img.shields.io/github/issues/ARCANEDEV/GeoIP.svg?style=flat-square)](https://github.com/ARCANEDEV/GeoIP/issues)

*By [ARCANEDEV&copy;](http://www.arcanedev.net/)*

### Requirements
    
    - PHP >= 5.4.0
    
### Composer

You can install the package via [Composer](http://getcomposer.org/). Add this to your `composer.json`:

```json
{
    "require": {
        ...
        "arcanedev/geo-ip": "~1.0"
    }
}
```
    
Then install via `composer install` or `composer update`.

### Laravel Installation
Once the package is installed, you can register the service provider in `app/config/app.php` in the `providers` array:

```php
'providers' => [
    ...
    'Arcanedev\GeoIP\ServiceProvider',
],
```

And the facade in the `aliases` array:

```php
'aliases' => [
    ...
    'GeoIP' => 'Arcanedev\GeoIP\Facade',
],
```

#### Artisan Commands
There are 2 commands available through this package:
```
php artisan geo-ip:install
```

Which simply migrate and seed all IPs and countries data for this package. Or

```
php artisan geo-ip:dump
```

Which generate a SQL File for your database.

### Configuration
Publish the package configuration by using this command:

```
php artisan config:publish arcanedev/geo-ip
```

Update your settings in the generated `app/config/packages/arcanedev/geo-ip` configuration file.

```php
return [
    'connection' => 'mysql',
    'prefix'     => 'geo_',
    'table'      => [
        'nations'   => 'nations',
        'countries' => 'countries',
    ],
    'dump'       => app_path() . '/database/geo-db.sql'
];
```

## USAGE
Coming soon ...

### TODOS:

  - [ ] Documentation
  - [ ] Examples
  - [ ] More tests and code coverage.
  - [ ] Refactoring.

### CREDIT

Thanks to [ip2nation.com](http://ip2nation.com/) for the database.
