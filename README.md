[![MIT license](https://img.shields.io/github/license/mashape/apistatus.svg)](http://opensource.org/licenses/MIT) [![codecov.io](https://img.shields.io/codecov/c/github/josepcrespo/oo-wordpress-nonces.svg)](https://codecov.io/github/josepcrespo/oo-wordpress-nonces)

----------

Table of contents:

- [OoWordpressNonces](#oowordpressnonces)
  * [Disclaimer](#disclaimer)
  * [Introduction](#introduction)
  * [Composer Package](#composer-package)
  * [Local development](#local-development)
    + [Get a copy of the project](#get-a-copy-of-the-project)
    + [Install Composer](#install-composer)
    + [Install the dependencies](#install-the-dependencies)
    + [Run the Tests](#run-the-tests)

----------

# OoWordpressNonces

## Disclaimer

This is a demo project to provide an example of my skills on object oriented programming using [PHP](http://www.php.net/), writing [PHPUnit](https://phpunit.de/) unitary tests and, taking advantage of tools like [Composer](https://getcomposer.org/), [Git](https://git-scm.com/), [GitHub](https://github.com/) and, the [Unix Shell](https://en.wikipedia.org/wiki/Unix_shell).

This project has not been wrote in any case thinking to be used in production, but can be used as you wants under your total responsability. You can also fork it and, use as a foundation for your own project if you found it useful.

## Introduction

**OoWordpressNonces** is a *Composer* package for [WordPress](https://wordpress.org/) to deal with *WordPress Nonces* using an *Object Oriented Programming* approach.

It does not replaces the original [WordPress Nonces](https://codex.wordpress.org/WordPress_Nonces) system, this package is only a wrapper, using an *OOP* approach, to the original *WordPress Nonces* functions.

The code is simple, self explanatory and, it is fully documented. On the code source, each class method has a link to the original WordPress function it wraps. For more details you can view the [official WordPress documentation for Nonces](https://developer.wordpress.org/?s=nonce)

----------

## Composer Package

You can install **OoWordpressNonces** by adding this package repository specification to your project's `composer.json` file:
<pre><code class="language-javascript">{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/josepcrespo/oo-wordpress-nonces"
        }
    ],
    "require": {
        "josepcrespo/oo-wordpress-nonces": "master"
    }
}
</code></pre>
and then run `php composer.phar update`.

----------

## Local development

In this section, you can get the instructions to setup this project on your local machine for development and testing purposes.

----------

### Get a copy of the project

Clone the project using [Git](https://git-scm.com/):

`git clone https://github.com/josepcrespo/oo-wordpress-nonces.git`

or, download a [ZIP](https://en.wikipedia.org/wiki/Zip_%28file_format%29) file with all the project files:
https://github.com/josepcrespo/oo-wordpress-nonces/archive/master.zip

### Install Composer

> **:exclamation: Before starting to install Composer:**
> - [PHP](http://www.php.net/) installed on your system is a mandatory requirement. If your development environment runs on [macOS](https://www.apple.com/macos/), I recommend install it using [Homebrew](https://brew.sh/)
> - Before starting to use *Homebrew* it is very recommended to have [Xcode](https://developer.apple.com/xcode/) installed and updated. You can [install/update Xcode](https://itunes.apple.com/es/app/xcode/id497799835?mt=12) using the [macOS App Store](https://www.appstore.com/). 
> - If you are using *macOS*, you also need to install the [Xcode Command Line Tools](https://developer.apple.com/xcode/features/). To install/update the *Xcode Command Line Tools*, write this command using the [Terminal.app](https://en.wikipedia.org/wiki/Terminal_(macOS)) (after having *Xcode* installed or updated): `xcode-select --install`

To quickly install *Composer* in the current directory, please, refer to the [official Composer download page](https://getcomposer.org/download/) for updated instructions.

----------

### Install the dependencies

To install the defined dependencies for your project, just run the *Composer* install command into the project root directory using the *Terminal.app* (if you are using *macOS*) or with your preferred *Shell*:

`php composer.phar install`

You may want to look into [the official Composer guidelines for Installing Dependencies](https://getcomposer.org/doc/01-basic-usage.md#installing-dependencies) for more details.
> **:warning: If you used the `--filename` option on the *Composer* installation**
> - Maybe you installed your *Composer* using the `--filename` installer option, for example in this way:
> `php composer-setup.php --filename=composer`
> In that case, you should run `composer install` in order to install the dependencies.

----------

### Run the Tests

The *Unitary Tests* of this package has been made using [PHPUnit](https://phpunit.de/).

1. First, create the *PHPUnit* configuration file executing the following command in the project root directory using the *Terminal.app* (if you are using *macOS*) or with your preferred *Shell*:

`cp phpunit.xml.dist phpunit.xml`

2. Assuming that you have all the dependencies installed using *Composer*, you can run the *Unitary Tests* by simply executing the following command in the root directory of the project:

`vendor/bin/phpunit`

After running the tests, you can view the tests coverage results by opening the `index.html` file created under the `tests/code-coverage-reports/html-format/` folder.

> **:warning: If *PHPUnit* throws an error message saying that it can not find some *Class* used in the tests.**
> - Use the following *Composer*'s command and, then re-run the tests.
>
> `php composer.phar dump-autoload`

> **:warning: You need Xdebug PHP extension enabled.**
> - *PHPUnit*'s code coverage functionality is configured by default for this project. It makes use of the *PHP_CodeCoverage* component, which in turn leverages the code coverage functionality provided by the [Xdebug](https://xdebug.org/) extension for PHP.
> - If you don't want to see code coverage or, you can not properly enable the Xdebug extension, you can remove the full `<logging>` entry present in the phpunit.xml configuration file.
