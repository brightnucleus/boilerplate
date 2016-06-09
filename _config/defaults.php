<?php
/**
 * Bright Nucleus Boilerplate.
 *
 * @package   BrightNucleus\Boilerplate
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   MIT
 * @link      http://www.brightnucleus.com/
 * @copyright 2016 Alain Schlesser, Bright Nucleus
 */

namespace BrightNucleus\Boilerplate;

use BrightNucleus\Boilerplate\Scripts\SetupHelper;
use BrightNucleus\Boilerplate\Scripts\Validation;

/*
 * Folder layout.
 */
$folders = [
    'config'    => SetupHelper::getFolder('_config'),
    'scripts'   => SetupHelper::getFolder('_scripts'),
    'templates' => SetupHelper::getFolder('_templates'),
];

/*
 * Placeholder definitions.
 */
$placeholders = [
    'Vendor'      => [
        'name'        => 'Vendor name',
        'description' => 'The vendor name of the package (probably your company\'s name).',
        'validation'  => function ($placeholder) { return Validation::validateTrimmed($placeholder); },
        'default'     => 'Bright Nucleus',
    ],
    'VendorPC'    => [
        'name'        => 'Vendor name in PascalCase',
        'description' => 'The vendor name of the package in "PascalCase" (no spaces, each word starting with a capital).',
        'validation'  => function ($placeholder) { return Validation::validatePascalCase($placeholder); },
        'default'     => function ($placeholders) {
            return SetupHelper::getPascalCase($placeholders['Vendor']['value']);
        },
    ],
    'vendor'      => [
        'name'        => 'Vendor name in lowercase',
        'description' => 'The vendor name of the package in "lowercase" (no spaces, each word starting with a lower case letter).',
        'validation'  => function ($placeholder) { return Validation::validateLowerCase($placeholder); },
        'default'     => function ($placeholders) {
            return SetupHelper::getLowerCase($placeholders['VendorPC']['value']);
        },
    ],
    'Package'     => [
        'name'        => 'Package name',
        'description' => 'The name of the package.',
        'validation'  => function ($placeholder) { return Validation::validateTrimmed($placeholder); },
        'default'     => 'Package Name',
    ],
    'PackagePC'   => [
        'name'        => 'Package name in PascalCase',
        'description' => 'The package name of the package in "PascalCase" (no spaces, each word starting with a capital).',
        'validation'  => function ($placeholder) { return Validation::validatePascalCase($placeholder); },
        'default'     => function ($placeholders) {
            return SetupHelper::getPascalCase($placeholders['Package']['value']);
        },
    ],
    'package'     => [
        'name'        => 'Package name in lowercase',
        'description' => 'The package name of the package in "lowercase" (no spaces, each word starting with a lower case letter).',
        'validation'  => function ($placeholder) { return Validation::validateLowerCase($placeholder); },
        'default'     => function ($placeholders) {
            return SetupHelper::getLowerCase($placeholders['PackagePC']['value']);
        },
    ],
    'description' => [
        'name'        => 'Package description',
        'description' => 'The package description in one sentence.',
        'validation'  => function ($placeholder) { return Validation::validateTrimmed($placeholder); },
        'default'     => 'TODO: Describe what this package is all about.',
    ],
    'author'      => [
        'name'        => 'Author name',
        'description' => 'The name of the author of the package.',
        'validation'  => function ($placeholder) { return Validation::validateTrimmed($placeholder); },
        'default'     => 'Alain Schlesser',
    ],
    'email'       => [
        'name'        => 'Author email',
        'description' => 'The email of the author.',
        'validation'  => function ($placeholder) { return Validation::validateEmail($placeholder); },
        'default'     => 'alain.schlesser@gmail.com',
    ],
    'url'         => [
        'name'        => 'Author URL',
        'description' => 'The website of the author or the package.',
        'validation'  => function ($placeholder) { return Validation::validateURL($placeholder); },
        'default'     => 'https://www.brightnucleus.com/',
    ],
    'year'        => [
        'name'        => 'Copyright year',
        'description' => 'The year for which the copyright is displayed. Can include a range of years as well.',
        'validation'  => function ($placeholder) { return Validation::validateYear($placeholder); },
        'default'     => date('Y'),
    ],
    'date'        => [
        'name'        => 'Date',
        'description' => 'Date to be used for first change log entry.',
        'validation'  => function ($placeholder) { return Validation::validateDate($placeholder); },
        'default'     => date('Y-m-d'),
    ],
];

return [
    'BrightNucleus' => [
        'Boilerplate' => [
            'Folders'           => $folders,
            'Placeholders'      => $placeholders,
            'TemplateExtension' => '.template',
        ],
    ],
];
