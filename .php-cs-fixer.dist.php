<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->exclude('var')
    ->exclude('vendor')
    ->exclude('migrations')
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@Symfony' => true,
        'array_syntax' => ['syntax' => 'short'],
        'ordered_imports' => ['sort_algorithm' => 'alpha'],
        'no_unused_imports' => true,
        'concat_space' => ['spacing' => 'one'],
    ])
    ->setFinder($finder)
    ;
