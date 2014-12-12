# Handlebars.php Helpers

[![Build Status](https://travis-ci.org/JustBlackBird/handlebars.php-helpers.svg)](https://travis-ci.org/JustBlackBird/handlebars.php-helpers)

> Provides a set of helpers for [Handlebars.php](https://github.com/XaminProject/handlebars.php) template engine.


## Installation

Simply add a dependency on `justblackbird/handlebars.php-helpers` to your
project's `composer.json` file if you use [Composer](http://getcomposer.org/) to
manage the dependencies of your project.


## Usage

To use all helpers in your templates just create an instance of helpers set and
attach it to Handlebars engine.

```php
$helpers = new \JustBlackBird\HandlebarsHelpers\Helpers();
$engine = new \Handlebars\Handlebars(array('helpers' => $helpers));
```

Want to use only subset of helpers? Fine. Just create an instance of appropriate
helpers set and attach it to Handlebars engine. Here is an example for Date
helpers:

```php
$helpers = new \JustBlackBird\HandlebarsHelpers\Date\Helpers();
$engine = new \Handlebars\Handlebars(array('helpers' => $helpers));
```

Want to use only chosen helpers? No problem. Just add them manually to your
helpers set:

```php
$engine = new \Handlebars\Handlebars();
$engine->getHelpers()->add(
    'ifEqual',
    new \JustBlackBird\HandlebarsHelpers\Comparison\IfEqualHelper()
);
```


## License

[MIT](http://opensource.org/licenses/MIT) (c) Dmitriy Simushev
