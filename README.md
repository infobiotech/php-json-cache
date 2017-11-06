# php-json-cache

A JSON-based PSR-16 cache implementation.

## Why JSON?

Some web hosts do not support APCu, Memcached, Redis and other major cache drivers.

## Getting Started

### Prerequisites

* PHP 5.6 or PHP 7.0

### Installing via composer

```
composer require infobiotech/php-json-cache
```

## Usage

TODO

## Tests

### Running Tests

``` bash
$ ./vendor/bin/phpunit
```

### Running PHP Code Sniffer

``` bash
$ ./vendor/bin/phpcs src --standard=psr2 -sp
```

## Built With

* [PHP-FIG PSR-16](http://www.php-fig.org/psr/psr-16/): a common interface for caching libraries.
* [Psr\SimpleCache](https://github.com/php-fig/simple-cache): a repository that holds all interfaces related to PSR-16.
* [League\Flysystem](https://flysystem.thephpleague.com/): a filesystem abstraction that allows to easily swap out a local filesystem for a remote one.

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/infobiotech/php-json-cache/tags).

## Authors

* **Alessandro Raffa** - *Initial work* - [infobiotech](https://github.com/infobiotech)

See also the list of [contributors](https://github.com/infobiotech/php-json-cache/contributors) who participated in this project.

## Contributing

Contributions are welcome and will be credited.

We accept contributions via Pull Requests on [Github](https://github.com/infobiotech/php-json-cache).

1. **Fork** our repository (<https://github.com/infobiotech/php-json-cache/fork>)
2. Create one **feature branch** per feature (`git checkout -b feature/fooBar`) - We won't pull from your master branch.
3. Use **[PSR-2 Coding Standard](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md)** - The easiest way to apply the conventions is to install [PHP Code Sniffer](http://pear.php.net/package/PHP_CodeSniffer).
4. **Document any change in behaviour** - Make sure the [README.md](README.md) and any other relevant documentation are kept up-to-date.
5. **Add tests** - Your patch won't be accepted if it doesn't have tests.
6. **Ensure tests pass!** - Please run the tests (see below) before submitting your pull request, and make sure they pass. We won't accept a patch until all tests pass.
7. **Ensure no coding standards violations** - Please run PHP Code Sniffer using the PSR-2 standard (see [Running PHP Code Sniffer](https://github.com/infobiotech/php-json-cache#running-php-code-sniffer)) before submitting your pull request. A violation will cause the build to fail, so please make sure there are no violations. We can't accept a patch if the build fails.
8. **Commit** your changes (`git commit -am 'Add some fooBar'`)
9. Try to **follow [SemVer](http://semver.org/)**. Randomly breaking public APIs is not an option.
10. Send **coherent history** - Make sure each individual commit in your pull request is meaningful. If you had to make multiple intermediate commits while developing, please squash them before submitting.
11. **Push** to the branch (`git push origin feature/fooBar`)
12. **Create a new Pull Request** - Please one pull request per feature. If you want to do more than one thing, send multiple pull requests.

Please read [CONTRIBUTING.md](CONTRIBUTING.md) for details on our code of conduct.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
