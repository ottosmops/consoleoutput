# A trait to split Laravel Console Output to stdout and stderr

[![GitHub license](https://img.shields.io/github/license/ottosmops/consoleoutput.svg)](https://github.com/ottosmops/consoleoutput/blob/master/LICENSE.md)
[![Latest Stable Version](https://poser.pugx.org/ottosmops/consoleoutput/v/stable?format=flat-square)](https://packagist.org/packages/ottosmops/consoleoutput)
[![Packagist Downloads](https://img.shields.io/packagist/dt/ottosmops/consoleoutput.svg?style=flat-square)](https://packagist.org/packages/ottosmops/consoleoutput)

Just a trait you can pull into your Laravel-Commands. This should help to make the commands behave more like you would expect ("Silence is golden."). The trait is inspired by this blog-post: http://fideloper.com/laravel-symfony-console-commands-stderr

The effect: Erros and warnings are sent to ```stderr```. Other messages are sent to ```stdout``` only if you call the command with ```-v```or ```-vv```. You can overwirte this whe you call the methods. Otherwise you don´t get output.

## Methods
```php 
debug($message, $verbosityLevel = 'vv')     // black output
info($message, $verbosityLevel = 'v')       // blue output
success($message, $verbosityLevel = 'v')    // green
warn($message, $verbosityLevel = 'normal')  // orange
error($message, $verbosityLevel = 'normal') // red
fatal($message, $verbosityLevel = 'normal') //red and exits
```

## Installation

```bash
composer require ottosmops/consoleoutput
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

