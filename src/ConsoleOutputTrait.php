<?php

namespace Ottosmops\ConsoleOutput;

use \Symfony\Component\Console\Output\ConsoleOutputInterface;

/*
 *  Levels
 *  ------
 *  'quiet' => OutputInterface::VERBOSITY_QUIET (no output)
 *  'normal' => OutputInterface::VERBOSITY_NORMAL (error, warn)
 *  'v' => OutputInterface::VERBOSITY_VERBOSE (info)
 *  'vv' => OutputInterface::VERBOSITY_VERY_VERBOSE (debug)
 *  'vvv' => OutputInterface::VERBOSITY_DEBUG
 */

/*
 * Default Behaviour
 * -----------------
 * debug -> stdout with option '-vv'
 * line  -> stdout with option '-v' or '-vv'
 * info  -> stdout with option '-v' or '-vv'
 * warn  -> stderr
 * error -> stderr
 */

trait ConsoleOutputTrait
{
    protected $colors = [
        'red' => "\e[31m",
        'blue' => "\e[34m",
        'green' => "\e[32m",
        'orange' => "\e[33m",
        'black' => "\e[30m",
    ];

    public function debug($message, $verbosityLevel = 'vv')
    {
        $this->checkVerbosity($verbosityLevel) && $this->writeln(STDOUT, $message, 'black');
    }

    public function info($message, $verbosityLevel = 'v')
    {
        if (php_sapi_name() === 'cli') {
            $this->checkVerbosity($verbosityLevel) && $this->writeln(STDOUT, $message, 'blue');
        } else {
            $this->checkVerbosity($verbosityLevel) && \Log::info($message);
        }
    }

    public function success($message, $verbosityLevel = 'v')
    {
        if (php_sapi_name() === 'cli') {
            $this->checkVerbosity($verbosityLevel) && $this->writeln(STDOUT, $message, 'green');
        } else {
            $this->checkVerbosity($verbosityLevel) && \Log::debug('SUCCESS: ' .$message);
        }
    }

    public function warn($message, $verbosityLevel = 'normal')
    {
        if (php_sapi_name() === 'cli') {
            $this->checkVerbosity($verbosityLevel) && $this->writeln(STDERR, $message, 'orange');
        } else {
            $this->checkVerbosity($verbosityLevel) && \Log::warning($message);
        }
    }

    public function error($message, $verbosityLevel = 'normal')
    {
        if (php_sapi_name() === 'cli') {
            $this->checkVerbosity($verbosityLevel) && $this->writeln(STDERR, $message, 'red');
        } else {
            $this->checkVerbosity($verbosityLevel) && \Log::error($message);
        }
    }

    public function fatal($message, $verbosityLevel = 'normal')
    {
        if (php_sapi_name() === 'cli') {
            $this->checkVerbosity($verbosityLevel) && $this->writeln(STDERR, $message, 'red');
            exit(1);
        } else {
            $this->checkVerbosity($verbosityLevel) && \Log::emergency($message);
        }
    }

    protected function checkVerbosity($verbosityLevel)
    {
        if ($this->output->getVerbosity() >= $this->parseVerbosity($verbosityLevel)) {
            return true;
        }
        return false;
    }

    protected function writeln($channel, $message, $color = "")
    {
        $color = $this->colors[$color];
        STDERR == $channel && fwrite(STDERR, "$color" . $message . PHP_EOL);
        STDOUT == $channel && fwrite(STDOUT, "$color" . $message . PHP_EOL);
    }
}
