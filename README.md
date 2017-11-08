[!["infobiotech logo"](logo-infobiotech-black-noclaim.png)](http://infobiotech.net?ibtref=github-readme-header)

# infobiotech/php-json-cache

[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%205.6-8892BF.svg?style=flat-square)](https://php.net/)
[![Latest Stable Version](https://poser.pugx.org/infobiotech/php-json-cache/v/stable?format=flat-square)](https://packagist.org/packages/infobiotech/php-json-cache)
[![Latest Unstable Version](https://poser.pugx.org/infobiotech/php-json-cache/v/unstable?format=flat-square)](https://packagist.org/packages/infobiotech/php-json-cache)
[![Total Downloads](https://poser.pugx.org/infobiotech/php-json-cache/downloads?format=flat-square)](https://packagist.org/packages/infobiotech/php-json-cache)
[![composer.lock](https://poser.pugx.org/infobiotech/php-json-cache/composerlock?format=flat-square)](https://packagist.org/packages/infobiotech/php-json-cache)
[![Dependency Status](https://www.versioneye.com/user/projects/5a01c57d0fb24f14d7b411dd/badge.svg?style=flat-square)](https://www.versioneye.com/user/projects/5a01c57d0fb24f14d7b411dd)
[![License](https://poser.pugx.org/infobiotech/php-json-cache/license?format=flat-square)](https://packagist.org/packages/infobiotech/php-json-cache)

A key-value JSON-based PSR-16 cache implementation.

|              | branch | build status | code coverage | code quality |
| ------------ | ------ | ------------ | ------------- | ------------ |
| Travis CI    | master | [![Build Status](https://travis-ci.org/infobiotech/php-json-cache.svg?branch=master&format=flat-square)](https://travis-ci.org/infobiotech/php-json-cache) | | |
| CodeCov      | master |              | [![codecov](https://codecov.io/gh/infobiotech/php-json-cache/branch/master/graph/badge.svg)](https://codecov.io/gh/infobiotech/php-json-cache) | |
| Scrutinizer  | master | [![Build Status](https://scrutinizer-ci.com/g/infobiotech/php-json-cache/badges/build.png?b=master)](https://scrutinizer-ci.com/g/infobiotech/php-json-cache/build-status/master) |               | [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/infobiotech/php-json-cache/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/infobiotech/php-json-cache/?branch=master) |
| Code Climate | master |              | [![Test Coverage](https://api.codeclimate.com/v1/badges/15e7b0aa9a35fe0dfffe/test_coverage)](https://codeclimate.com/github/infobiotech/php-json-cache/test_coverage) | [![Maintainability](https://api.codeclimate.com/v1/badges/15e7b0aa9a35fe0dfffe/maintainability)](https://codeclimate.com/github/infobiotech/php-json-cache/maintainability) |
| Codacy       | master |              |               | [![Codacy Badge](https://api.codacy.com/project/badge/Grade/446dcd15de1647aaa0af4e0ba0d9f021)](https://www.codacy.com/app/alessandroraffa/php-json-cache?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=infobiotech/php-json-cache&amp;utm_campaign=Badge_Grade) |

Built with:
* [PHP-FIG PSR-16](http://www.php-fig.org/psr/psr-16/): a common interface for caching libraries.
* [Psr\SimpleCache](https://github.com/php-fig/simple-cache): a repository that holds all interfaces related to PSR-16.
* [League\Flysystem](https://flysystem.thephpleague.com/): a filesystem abstraction that allows to easily swap out a local filesystem for a remote one.

## Why JSON?

* In some situations, remote web hosts do not support (or do not allow to install) major cache drivers.
* JSON objects allow to set/get key-value items.

## Getting Started

### Prerequisites

* PHP 5.6 or greater

### Installing via composer

Make sure you have [composer](http://getcomposer.org/) installed.

Then run the following command from your project root:

```sh
$ composer require infobiotech/php-json-cache
```

## Usage

**infobiotech/php-json-cache** implements [PSR-16](http://www.php-fig.org/psr/psr-16/) and thus provides a standardized API for storing and retrieving data.

Here is a simple use case

```php
<?php

require 'vendor/autoload.php';

$filesystemAdapter = new League\Flysystem\Adapter\Local('.');

$jsonCache         = new Infobiotech\JsonCache($filesystemAdapter, uniqid());

$jsonCache->set('key', 'value'); // return TRUE

$jsonCache->get('key'); // return 'value'
```

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

```sh
$ ./vendor/bin/phpunit
```

### Running PHP Code Sniffer

```sh
$ ./vendor/bin/phpcs src --standard=psr2 -sp
```

## Versioning

We try to follow [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/infobiotech/php-json-cache/tags).

## Authors

* **Alessandro Raffa** - *Initial work* - [infobiotech](https://github.com/infobiotech)

See also the list of [contributors](https://github.com/infobiotech/php-json-cache/contributors) who participated in this project.

## Contributing

Contributions are welcome and will be credited.

We accept contributions via Pull Requests on [Github](https://github.com/infobiotech/php-json-cache).

1. [Fork our repository](<https://github.com/infobiotech/php-json-cache/fork>).
2. Create one feature branch per feature (`git checkout -b feature/fooBar`) - We won't pull from your master branch.
3. Use [PSR-2 Coding Standard](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md) - The easiest way to apply the conventions is to install [PHP Code Sniffer](http://pear.php.net/package/PHP_CodeSniffer).
4. Document any change in behaviour - Make sure the [README.md](README.md) and any other relevant documentation are kept up-to-date.
5. Add tests - Your patch won't be accepted if it doesn't have tests.
6. Ensure tests pass! - Please run the tests (see below) before submitting your pull request, and make sure they pass. We won't accept a patch until all tests pass.
7. Ensure no coding standards violations - Please run PHP Code Sniffer using the PSR-2 standard (see [Running PHP Code Sniffer](https://github.com/infobiotech/php-json-cache#running-php-code-sniffer)) before submitting your pull request. A violation will cause the build to fail, so please make sure there are no violations. We can't accept a patch if the build fails.
8. Commit your changes (`git commit -am 'Add some fooBar'`).
9. Try to follow [SemVer](http://semver.org/). Randomly breaking public APIs is not an option.
10. Send coherent history - Make sure each individual commit in your pull request is meaningful. If you had to make multiple intermediate commits while developing, please squash them before submitting.
11. Push to the branch (`git push origin feature/fooBar`).
12. Create a new Pull Request - Please one pull request per feature. If you want to do more than one thing, send multiple pull requests.

Please read [CONTRIBUTING.md](CONTRIBUTING.md) for details on our code of conduct.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details