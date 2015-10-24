# Phalcon Demo Application

We use modified [Phalcon INVO Application][1] to demonstrate basics of Codeception testing.
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

* PHP >= 5.4
* [Nginx][2] Web Server with [PHP-FPM][3] enabled
* Latest stable [Phalcon Framework release][4] extension enabled
* [MySQL][5] >= 5.1.5

### Installation

First you need to clone this repository:

```
$ git clone git@github.com:Codeception/phalcon-demo.git
```

Then you'll need to create the database and initialize schema:

```sh
$ echo 'CREATE DATABASE phalcon_demo CHARSET=utf8 COLLATE=utf8_unicode_ci' | mysql -u root
$ cat schemas/phalcon_demo.sql | mysql -u root phalcon_demo
```

Also you can override application config by creating `app/config/config.ini.dev` (already gitignored).

## Contributing

See [CONTRIBUTING.md][6]

## License
<center>
Phalcon Demo Application is open-sourced software licensed under the [New BSD License][7].<br>
© 2012 - 2015 Phalcon Framework Team and contributors<br>
© 2015 Codeception Team and contributors
</center>

[1]: https://phalconphp.com/
[2]: http://nginx.org/
[3]: http://php.net/manual/en/install.fpm.php
[4]: https://github.com/phalcon/cphalcon/releases
[5]: https://www.mysql.com/
[6]: https://github.com/phalcon/invo/blob/master/CONTRIBUTING.md
[7]: https://github.com/phalcon/invo/blob/master/docs/LICENSE.md
