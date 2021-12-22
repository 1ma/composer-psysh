## uma/composer-psysh

A no-frills PsySH-Composer plugin.

In a nutshell, it provides a `composer psy` subcommand that spawns a [Psy Shell](https://psysh.org/) with autoload
integration when applicable.

<div align="center">
  <img alt="composer-psysh in action" src="https://i.imgur.com/OZADJUV.gif">
</div>

### Installation

This package is meant to be used as a global requirement for your Composer installation:

```bash
$ composer global require uma/composer-psysh
```

Alternatively it can be required on a per-project basis as a development dependency.
Note that in this case the `psy` subcommand will only be available in the project root.

```bash
$ composer require --dev uma/composer-psysh
```

#### Composer 2.2 and above

Starting from version 2.2.0 Composer requires plugins to be whitelisted in the `composer.json` file.
After updating to +2.2, the first time you run `composer shell` it will ask you once if you want to
add the plugin to the `allow-plugins` config section.
You'll need to answer Yes.

```
$ composer shell
uma/composer-psysh contains a Composer plugin which is currently not in your allow-plugins config. See https://getcomposer.org/allow-plugins
Do you trust "uma/composer-psysh" to execute code and wish to enable it now? (writes "allow-plugins" to composer.json) [y,n,d,?] y
Psy Shell v0.11.0 (PHP 8.1.0 — cli) by Justin Hileman
Active Autoloaders:
  /home/marcel/.config/composer/vendor/autoload.php

>>> "oh well"
```

### Usage

`composer psy` can be run anywhere and will spawn a generic REPL.
However, when it runs at the root of a project it will require the `vendor/autoload.php` script
so that the project's classes will be readily available in the shell.

The plugin also defines a couple of other aliases: `composer repl` and `composer shell`.

### Comparison between `uma/composer-psysh` and `ramsey/composer-repl`

This package was inspired by [`ramsey/composer-repl`](https://github.com/ramsey/composer-repl).
In fact, it only provides a subset of its features.
I decided to write my own version for a couple of reasons:

First, Ben Ramsey's plugin requires PHP 7.4 or later, which is too restrictive for me.
`uma/composer-psysh` allows a wide range of PHP versions: from 5.5 to 8.0.
This is pretty similar to the range of versions allowed by PsySH and Composer themselves.

Second, `ramsey/composer-repl` has additional functionality to integrate PHPUnit into PsySH.
Because of this it has a hard dependency on `phpunit/phpunit`.
I wasn't keen on being forced to pull PHPUnit alongside the plugin, especially since I don't need that feature.

### Caveats

Only works on Unix environments (for now?)
