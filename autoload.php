<?php

/*
 * This file is part of Cliched.
 *
 * (c) Gustavo Falco <comfortablynumb84@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$autoloaders = array(
    __DIR__.'/vendor/autoload.php',
    __DIR__.'/../../autoload.php'
);

$loader = null;

foreach ($autoloaders as $autoloadFile) {
    if (is_file($autoloadFile)) {
        $loader = require_once $autoloadFile;

        break;
    }
}

if ($loader === null) {
    echo 'You must install this component\'s dependencies using Composer before trying to execute this binary.'.PHP_EOL;

    exit(2);
}

return $loader;