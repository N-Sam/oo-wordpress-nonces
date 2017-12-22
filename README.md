OopWordPressNonces
===================


**OopWordPressNonces** is a [Composer](https://getcomposer.org/) package for [WordPress](https://wordpress.org/) to deal with *Nonces* using an *Object Oriented Programming* approach.

It does not replaces the original [WordPress Nonces](https://codex.wordpress.org/WordPress_Nonces) system, this package is only a wrapper, using an *OOP* approach, to the original *WordPress Nonces* functions.

----------


Installing Composer
-------------
> **:exclamation::exclamation: Before starting to install Composer:**

> - [PHP](http://www.php.net/) installed on your system is a mandatory requirement. If your development environment runs on [macOS](https://www.apple.com/macos/), I recommend install it using [Homebrew](https://brew.sh/)
> - Before starting to use *Homebrew* it is very recommended to have [Xcode](https://developer.apple.com/xcode/) installed and updated. You can [install/update Xcode](https://itunes.apple.com/es/app/xcode/id497799835?mt=12) using the [macOS App Store](https://www.appstore.com/). 
> - You also need to install the [Xcode Command Line Tools](https://developer.apple.com/xcode/features/). To install/update the Xcode Command line tools, write this command in the Terminal.app (after having Xcode installed or updated):
> `xcode-select --install`
    
To quickly install *Composer* in the current directory, please, refer to the [official Composer download page](https://getcomposer.org/download/) for updated instructions.

Installing Dependencies
-------------
To install the defined dependencies for your project, just run the *Composer* install command into the project root directory:

`php composer.phar install`

You may want to look into [the official Composer guidelines for Installing Dependencies](https://getcomposer.org/doc/01-basic-usage.md#installing-dependencies) for more details.
> **:warning: If you used the --filename option on the Composer installation**

> - Maybe you installed your Composer using the `--filename` installer option, for example in this way:
> `php composer-setup.php --filename=composer`
> In that case, you should run `php composer install` in order to install the dependencies.