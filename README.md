# Phalcon Demo Application 

[![Build Status](https://travis-ci.org/Codeception/phalcon-demo.svg?branch=master)](https://travis-ci.org/Codeception/phalcon-demo)

We use **modified** [Phalcon INVO Application][1] to demonstrate basics of Codeception testing.
We expect to implement as many features as possible to showcase the framework and its
potential.

Please write us if you have any feedback.

Thanks.

## NOTE

The master branch will always contain the latest stable version. If you wish
to check older versions or newer ones currently under development, please
switch to the relevant branch.

## Get Started

### Requirements

* PHP >= 5.5
* [Nginx][2] Web Server with [PHP-FPM][3] enabled
* Latest stable [Phalcon Framework release][4] extension enabled
* [MySQL][5] >= 5.1.5

### Installation

First you need to clone this repository:

```sh
$ git clone git@github.com:Codeception/phalcon-demo.git
```

Install composer in a common location or in your project:

```sh
$ curl -s http://getcomposer.org/installer | php
```

Then install dependencies:

```sh
$ php composer.phar install
```

You'll need to create the database and initialize schema:

```sh
$ echo 'CREATE DATABASE phalcon_demo CHARSET=utf8 COLLATE=utf8_unicode_ci' | mysql -u root
$ cat schemas/phalcon_demo.sql | mysql -u root phalcon_demo
```

Also you can override application config by creating `app/config/config.ini.dev` (already gitignored).

## Tests

Phalcon Demo Application uses [Codeception][6] functional, acceptance and unit tests.

First you need to re-generate base classes for all suites:

```sh
$ vendor/bin/codecept build
```

You can execute all test with `run` command:

```sh
$ vendor/bin/codecept run
# OR
$ vendor/bin/codecept run --debug # Detailed output
```

Read more about the installation and configuration of Codeception:

* [Codeception Introduction][7]
* [Codeception Console Commands][8]

Some tests require a connection to the database. For those you need to create a test database using MySQL:

```sh
$ echo 'CREATE DATABASE phalcon_demo CHARSET=utf8 COLLATE=utf8_unicode_ci' | mysql -u root
```

For these tests we use the user `root` without a password. You may need to change this in `tests/codeception.yml`
and `app/config/config.ini.dev` files.

If you cannot run the tests, please refer to the `.travis.yml` file for more instructions how we test Phalcon Demo Application.
For detailed information on our application environment setting refer to `app/config/env.php` file.

### Functional Tests

Demonstrates testing of CRUD application with:

* [UserSteps][9]

## Contributing

See [CONTRIBUTING.md][15]

## License

Phalcon Demo Application is open-sourced software licensed under the [New BSD License][16].<br>
© 2012 - 2016 Phalcon Framework Team and contributors<br>
© 2015 Codeception Team and contributors

[1]: https://github.com/phalcon/invo/
[2]: http://nginx.org/
[3]: http://php.net/manual/en/install.fpm.php
[4]: https://github.com/phalcon/cphalcon/releases
[5]: https://www.mysql.com/
[6]: http://codeception.com/
[7]: http://codeception.com/docs/01-Introduction
[8]: http://codeception.com/docs/reference/Commands
[9]: https://github.com/Codeception/phalcon-demo/blob/master/tests/_support/User/Functional/UserSteps.php
[15]: https://github.com/phalcon/invo/blob/master/CONTRIBUTING.md
[16]: https://github.com/phalcon/invo/blob/master/LICENSE.txt

User/Functional/UserSteps.php
