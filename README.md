GeoIP for Laravel
==============
[![Travis Status](http://img.shields.io/travis/ARCANEDEV/GeoIP.svg?style=flat-square)](https://travis-ci.org/ARCANEDEV/GeoIP)
[![Github Release](http://img.shields.io/github/release/ARCANEDEV/GeoIP.svg?style=flat-square)](https://github.com/ARCANEDEV/GeoIP/releases)
[![Coverage Status](http://img.shields.io/coveralls/ARCANEDEV/GeoIP.svg?style=flat-square)](https://coveralls.io/r/ARCANEDEV/GeoIP?branch=master)
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
    "arcanedev/geo-ip": "dev-master"
    ...
  }
}
```
    
Then install via `composer install` or `composer update`.

### Laravel Installation
Once the package is installed, you can register the service provider in `app/config/app.php` in the `providers` array:

```php
'providers' => array(
    ...
    'Arcanedev\GeoIP\ServiceProvider',
    ...
)
```

And the facade in the `aliases` array:

```php
'aliases' => array(
    ...
    'Arcanedev\GeoIP\Facade',
    ...
)
```

### TODOS:

  - [ ] Documentation
  - [ ] Examples
  - [ ] More tests and code coverage.
  - [ ] Refactoring.
