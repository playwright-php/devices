<?php

$license = <<<LICENSE
This file is part of the Playwright PHP community project.
For the full copyright and license information, please view
the LICENSE file that was distributed with this source code.
LICENSE;

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__);

return (new PhpCsFixer\Config())
    ->setParallelConfig(PhpCsFixer\Runner\Parallel\ParallelConfigFactory::detect())
    ->setFinder($finder)
    ->setRiskyAllowed(true)
    ->setRules([
        '@Symfony' => true,
        'declare_strict_types' => true,
        'header_comment' => ['header' => $license],
    ])
;
