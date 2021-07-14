## uma/composer-psysh

A no-frills PsySH-Composer plugin.

In a nutshell, it provides a `composer psy` subcommand that spawns a [Psy Shell](https://psysh.org/) with autoload
integration when applicable.

### Installation

This package is meant to be used as a global requirement of your local Composer installation:

```bash
composer global require uma/composer-psysh
```

Alternatively it can be required on a per-project basis as a development dependency.
Note that in this case the `psy` subcommand will only be available in the project root.

```bash
composer require --dev uma/composer-psysh
```

### Usage

`composer psy` can be run anywhere and will provide a generic REPL.
However, when it runs at the root of a project it will silently require the `vendor/autoload.php` script
so that the project's classes will be readily available in the shell.

The plugin also defines a couple of aliases: `composer repl` and `composer shell`.

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
