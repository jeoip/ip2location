<?php

$finder = PhpCsFixer\Finder::create()
    ->in([
        __DIR__ . "/src",
        __DIR__ . "/database",
    ]);

$config = new PhpCsFixer\Config();
return $config->setRules([
        '@Symfony' => true,
    ])
    ->setFinder($finder)
;