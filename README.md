[!["infobiotech logo"](assets/logo-infobiotech-black-noclaim.png)](http://infobiotech.net?ibtref=github-readme-header)

# infobiotech/php-json-cache

[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%205.6-8892BF.svg?style=flat-square)](https://php.net/)
[![Latest Stable Version](https://poser.pugx.org/infobiotech/php-json-cache/v/stable?format=flat-square)](https://packagist.org/packages/infobiotech/php-json-cache)
[![Latest Unstable Version](https://poser.pugx.org/infobiotech/php-json-cache/v/unstable?format=flat-square)](https://packagist.org/packages/infobiotech/php-json-cache)
[![Total Downloads](https://poser.pugx.org/infobiotech/php-json-cache/downloads?format=flat-square)](https://packagist.org/packages/infobiotech/php-json-cache)
[![composer.lock](https://poser.pugx.org/infobiotech/php-json-cache/composerlock?format=flat-square)](https://packagist.org/packages/infobiotech/php-json-cache)
[![License](https://poser.pugx.org/infobiotech/php-json-cache/license?format=flat-square)](https://packagist.org/packages/infobiotech/php-json-cache)

A key-value JSON-based PSR-16 cache implementation.

Built with:
* [PHP-FIG PSR-16](http://www.php-fig.org/psr/psr-16/): a common interface for caching libraries.
* [Psr\SimpleCache](https://github.com/php-fig/simple-cache): a repository that holds all interfaces related to PSR-16.
* [League\Flysystem](https://flysystem.thephpleague.com/): a filesystem abstraction that allows to easily swap out a local filesystem for a remote one.

---

Here our Quality Assurance indicators for `master` git branch.

|              | build status | code coverage | code quality |
| ------------ | ------------ | ------------- | ------------ |
| Travis CI    | [![Build Status](https://travis-ci.org/infobiotech/php-json-cache.svg?branch=master&format=flat-square)](https://travis-ci.org/infobiotech/php-json-cache) | | |
| CodeCov      |              | [![codecov](https://codecov.io/gh/infobiotech/php-json-cache/branch/master/graph/badge.svg)](https://codecov.io/gh/infobiotech/php-json-cache) | |
| Scrutinizer  | [![Build Status](https://scrutinizer-ci.com/g/infobiotech/php-json-cache/badges/build.png?b=master)](https://scrutinizer-ci.com/g/infobiotech/php-json-cache/build-status/master) |               | [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/infobiotech/php-json-cache/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/infobiotech/php-json-cache/?branch=master) |
| Code Climate |              |               | [![Maintainability](https://api.codeclimate.com/v1/badges/15e7b0aa9a35fe0dfffe/maintainability)](https://codeclimate.com/github/infobiotech/php-json-cache/maintainability) |
| Codacy       |              | [![Codacy Badge](https://api.codacy.com/project/badge/Coverage/446dcd15de1647aaa0af4e0ba0d9f021)](https://www.codacy.com/app/alessandroraffa/php-json-cache?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=infobiotech/php-json-cache&amp;utm_campaign=Badge_Coverage) | [![Codacy Badge](https://api.codacy.com/project/badge/Grade/446dcd15de1647aaa0af4e0ba0d9f021)](https://www.codacy.com/app/alessandroraffa/php-json-cache?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=infobiotech/php-json-cache&amp;utm_campaign=Badge_Grade) |

---

## Why JSON?

* In some situations, remote web hosts do not support (or do not allow to install) major cache drivers.
* JSON objects allow to set/get key-value items.

## Getting Started

### Prerequisites

* PHP 5.6 or greater (including 7.0, 7.1 and [HHVM](https://hhvm.com/))

### Installing via composer

Make sure you have [composer](http://getcomposer.org/) installed.

Then run the following command from your project root:

```sh
$ composer require infobiotech/php-json-cache
```

## Usage

**infobiotech/php-json-cache** implements [PSR-16](http://www.php-fig.org/psr/psr-16/) and thus provides a standardized API for storing and retrieving data.

Here is a simple use case:

```php
<?php

require 'vendor/autoload.php';

$flysystemAdapter = new League\Flysystem\Adapter\Local('.');

$jsonCache         = new Infobiotech\JsonCache\Psr16\Driver($flysystemAdapter, uniqid());

$jsonCache->set('key', 'value'); // return TRUE

$jsonCache->get('key'); // return 'value'
```

### Migrations

#### From v0.x to v1.x

Due to a deep refactor and restructure, the instantiation code must change from this:

```php
$jsonCache = new Infobiotech\JsonCache(/* your adapter and your namespace */);
```

to this:

```php
$jsonCache = new Infobiotech\JsonCache\Psr16\Driver(/* your adapter and your namespace */);
```

The API is unchanged.

## Other PSR-16 implementations

* [sabre-io/cache](https://github.com/sabre-io/cache) - In-memory, APCu and Memcached cache abstraction layer.
* [matthiasmullie/scrapbook](https://github.com/matthiasmullie/scrapbook) - Full featured caching environment with several adapters.
* [SilentByte/litecache](https://github.com/SilentByte/litecache) - Lightweight code/opcode caching by generating `*.php` files for cached objects.
* [kodus/file-cache](https://github.com/kodus/file-cache) - Flat-file cache-implementation.
* [naroga/redis-cache](https://github.com/naroga/redis-cache) - A Redis driver implementation.
* [paillechat/apcu-simple-cache](https://github.com/paillechat/apcu-simple-cache) - APCu implementation.
* [kodus/mock-cache](https://github.com/kodus/mock-cache) - A PSR-16 mock cache for integration testing.

## Tests

### Running Tests

Run the following command from your project root:

```sh
$ ./vendor/bin/phpunit
```

### Running PHP Code Sniffer

Run the following command from your project root:

```sh
$ ./vendor/bin/phpcs src --standard=psr2 -sp
```

## Versioning

We try to follow [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/infobiotech/php-json-cache/tags).

## Authors

* **Alessandro Raffa** - *Initial work* - [infobiotech](https://github.com/infobiotech)

## Contributing

Contributions are welcome and will be credited.

Please read [CONTRIBUTING.md](CONTRIBUTING.md) for details on our code of conduct.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details