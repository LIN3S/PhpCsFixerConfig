<?php

/*
 * This file is part of the PhpCsFixerConfig library.
 *
 * Copyright (c) 2017-present LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

use LIN3S\PhpCsFixerConfig\Lin3sConfig;

$config = new Lin3sConfig('PhpCsFixerConfig library', '2017');
$config->getFinder()->in(__DIR__ . '/src');

$cacheDir = getenv('TRAVIS') ? getenv('HOME') . '/.php-cs-fixer' : __DIR__;

$config->setCacheFile($cacheDir . '/.php_cs.cache');

return $config;
