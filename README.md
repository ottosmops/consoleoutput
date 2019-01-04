# A trait to split Symfony/Laravel Console Output to stdout and stderr

[![GitHub license](https://img.shields.io/github/license/ottosmops/consoleoutput.svg)](https://github.com/ottosmops/consoleoutput/blob/master/LICENSE.md)
[![Latest Stable Version](https://poser.pugx.org/ottosmops/consoleoutput/v/stable?format=flat-square)](https://packagist.org/packages/ottosmops/consoleoutput)
[![Packagist Downloads](https://img.shields.io/packagist/dt/ottosmops/consoleoutput.svg?style=flat-square)](https://packagist.org/packages/ottosmops/consoleoutput)

A trait you can pull into your Laravel-Commands (```use \Ottosmops\Consoleoutput\ConsoleOutputTrait;```). This should help to make the commands behave more like you would expect ("Silence is golden."). The effect: Errors and warnings are sent to ```stderr```. Other messages are sent to ```stdout``` ***only if*** you call the command with ```-v```or ```-vv```. You can overwrite this when you call the methods. Just set another ```$verbosityLevel```.

The trait is inspired by this blog-post: http://fideloper.com/laravel-symfony-console-commands-stderr

## Installation

```bash
composer require ottosmops/consoleoutput
```

## Usage 

Just pull in the trait, and you are ready to go. 

```php 
class TestCommand extents Illuminate\Console\Command
{You
     use \Ottosmops\Consoleoutput\ConsoleOutputTrait;
     
     ...
     
     public function handle()
     {
        $this->info("This is only an info message."); // This message is only shown, if you call the command with '-v'. 
        $this->error("Here comes the error.");
     }
}

```


## Methods
```php 
debug($message, $verbosityLevel = 'vv')     // black output
info($message, $verbosityLevel = 'v')       // blue output
success($message, $verbosityLevel = 'v')    // green
warn($message, $verbosityLevel = 'normal')  // orange
error($message, $verbosityLevel = 'normal') // red
fatal($message, $verbosityLevel = 'normal') //red and exits
```

## Version 1.1 
To avoid errors, the methods check if you call them from the command line. Otherwise the Laravel-Log-Methods are called.



## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

