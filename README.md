# Bright Nucleus Boilerplate

[![Latest Stable Version](https://img.shields.io/packagist/v/brightnucleus/boilerplate.svg)](https://packagist.org/packages/brightnucleus/boilerplate)
[![Total Downloads](https://img.shields.io/packagist/dt/brightnucleus/boilerplate.svg)](https://packagist.org/packages/brightnucleus/boilerplate)
[![Latest Unstable Version](https://img.shields.io/packagist/vpre/brightnucleus/boilerplate.svg)](https://packagist.org/packages/brightnucleus/boilerplate)
[![License](https://img.shields.io/packagist/l/brightnucleus/boilerplate.svg)](https://packagist.org/packages/brightnucleus/boilerplate)

Boilerplate package you can use to quickly create a new package from scratch.

## Table Of Contents

* [Basic Usage](#basic-usage)
* [Customizing The Generated Boilerplate](#customizing-the-generated-boilerplate)
    * [Providing A Custom Config File](#providing-a-custom-config-file)
    * [Changing The Templates](#changing-the-templates)
    * [Changing The Placeholders](#changing-the-placeholders)
    * [Adding A Custom Setup Task](#adding-a-custom-setup-task)
* [Contributing](#contributing)
* [License](#license)

## Basic Usage

To create a new package using composer, use the following command:

```BASH
composer create-project brightnucleus/boilerplate <package-folder>
```

This will create a new folder called `<package-folder>`, clone the `brightnucleus/boilerplate` package into that folder, and run the setup scripts. These scripts will ask you several questions about the package you want to create.

## Customizing The Generated Boilerplate

If you want to use this package for your own purposes, you can either fork it and adapt the workflow and templates with some simple tweaks, or you can require it through Composer to extend it.

### Providing A Custom Config File

You can set the configuration file to be loaded through the `"extra"` key in the `composer.json` file:

```JSON
  "extra": {
    "brightnucleus-boilerplate": {
      "config-file": "_config/defaults.php",
      "config-prefix": "BrightNucleus/Boilerplate"
    }
  },
```

If you want to modify the key that is used for this (`"brightnucleus-boilerplate"`), you can override the `Setup::getExtraKey()` method.

```PHP
protected static function getExtraKey()
{
    return 'brightnucleus-boilerplate';
}
```

### Changing The Templates

The templates can be found in the `_templates` folder and can have an optional `.template` extension. Each template in that folder will be copied to the root folder, after it has been run through a Mustache renderer that replaces all the placeholders with the actual values you've provided during the script execution.

If there are subfolders within `_templates`, these subfolders and their content will also be mirrored within the root folder. So, you can build the entire file structure that will later land in your package root folder within this `_templates` folder.

Adding a new template is just a matter of adding a new file within that structure.

### Changing The Placeholders

The placeholders are defined within the `_config/defaults.php` file.

To add a new placeholder, you can just add a new element to the array referenced by `BrightNucleus/Boilerplate/Placeholders`.

Example:

```PHP
$placeholders = [
    // [...]
    // The placeholder tag that Mustache will look for.
    'greeting'      => [
        // The name of the placeholder displayed when the user is asked for values.
        'name'        => 'Greeting',
        // The description of the placeholder displayed when the user is asked for values.
        'description' => 'The greeting you want to send within your HelloWorld app.',
        // The validation callable that will either return the validate value or throw an exception.
        'validation'  => function ($placeholder) { return Validation::validateTrimmed($placeholder); },
        // The default value to use if the user doesn't provide one.
        'default'     => 'Hello World',
    ],
];
```

This example will add a new placeholder `{{greeting}}` that you can use within your templates.

The validation value passed to `'validation'` needs to be a callable that gets the current value entered by the user, and needs to either return the validated form of that value, or throw an exception if the value does not meet the requirements. The `Validation` class provides some helper methods to do the actual validation.

The default value passed into `'default'` can be either a literal value to use, or a callable that gets the array of placeholders as an argument, and needs to return a value to use. Using this array, you can make one default value depend on the current value of another placeholder, provided that that placeholder has already been set before (ordering within the config file).

### Adding A Custom Setup Task

The individual tasks are simple classes that implement the `BrightNucleus\Boilerplate\Scripts\SetupTask` interface:

```PHP
interface SetupTask
{

    /**
     * Get the name of the current task.
     *
     * @since 0.1.0
     *
     * @return string Name of the task.
     */
    public function getName();

    /**
     * Complete the setup task.
     *
     * @since 0.1.0
     *
     * @return void
     */
    public function complete();
}
```

In most cases, it is probably preferable to extend `BrightNucleus\Boilerplate\Scripts\Task\AbstractTask` though, as this provides some convenience functionality.

Here's an example task that displays a "Boilerplate" logo in the console:

```PHP
<?php namespace BrightNucleus\Boilerplate\Scripts\Task;

/**
* Class DisplayBoilerplateLogo.
*
* @since   0.1.0
*
* @package BrightNucleus\Boilerplate\Scripts\Task
* @author  Alain Schlesser <alain.schlesser@gmail.com>
*/
class DisplayBoilerplateLogo extends AbstractTask
{

    /**
    * Complete the setup task.
    *
    * @since 0.1.0
    *
    * @return void
    */
    public function complete()
    {
        $logo = <<<LOGO
         ____        _ _                 _       _
        | __ )  ___ (_) | ___ _ __ _ __ | | __ _| |_ ___
        |  _ \ / _ \| | |/ _ \ '__| '_ \| |/ _` | __/ _ \
        | |_) | (_) | | |  __/ |  | |_) | | (_| | |_  __/
        |____/ \___/|_|_|\___|_|  | .__/|_|\__,_|\__\___|
                                  |_|
LOGO;

        $this->io->write("<info>$logo</info>");
    }
}
```

Now, to hook this task up to the setup process, you insert the class name into the `getSetupTasks()` method of the `BrightNucleus\Boilerplate\Scripts\Setup` class.

The array of classes is executed in the order in which the classes have been added, so if we want to display our new logo as the very first step to be taken, we insert it at the top of the array.

```PHP
<?php namespace BrightNucleus\Boilerplate\Scripts;

class Setup
{

    // [...]

    protected static function getSetupTasks(Event $event)
    {
        return [
            DisplayBoilerplateLogo::class, // <-- We've added our new task step here.
            AskAboutProjectParameters::class,
            VerifyProjectParameters::class,
            RemoveExistingRootFiles::class,
            ReplacePlaceholdersInTemplateFiles::class,
            MoveTemplateFilesToRootFolder::class,
            RemoveConfigFolder::class,
            RemoveTemplatesFolder::class,
            RemoveOriginalVCSData::class,
            InitializeVCS::class,
        ];
    }
}
```

If we now run our `composer create-project` command, Composer will first download everything it needs, then start the custom setup process by displaying the new logo first.

## Contributing

All feedback / bug reports / pull requests are welcome.

## License

Copyright (c) 2016 Alain Schlesser, Bright Nucleus

This code is licensed under the [MIT License](LICENSE).
