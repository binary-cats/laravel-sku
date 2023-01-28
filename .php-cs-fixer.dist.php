<?php

/*
|--------------------------------------------------------------------------
| Configure PHP CS Fixer
|--------------------------------------------------------------------------
|
| Set locations to fix files in
*/
$finder = PhpCsFixer\Finder::create()->in([
    __DIR__.'/src',
    __DIR__.'/tests',
]);

/*
|--------------------------------------------------------------------------
| Configure PHP CS Fixer
|--------------------------------------------------------------------------
|
| Define rules
*/
$rules = [
    '@Symfony' => true,
    'concat_space' => ['spacing' => 'one'],
    'new_with_braces' => true,
    'no_superfluous_phpdoc_tags' => false,
    'not_operator_with_successor_space' => true,
    'ordered_imports' => ['sort_algorithm' => 'alpha'],
    'php_unit_method_casing' => ['case' => 'snake_case'],
    'phpdoc_separation' => false,
    'phpdoc_align' => ['align' => 'left'],
];

/*
|--------------------------------------------------------------------------
| Configure PHP CS Fixer
|--------------------------------------------------------------------------
|
| Complete config
*/

$config = new PhpCsFixer\Config();

return $config
    ->setFinder($finder)
    ->setRiskyAllowed(true)
    ->setRules($rules);
