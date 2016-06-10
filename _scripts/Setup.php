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

namespace BrightNucleus\Boilerplate\Scripts;

use BrightNucleus\Boilerplate\Scripts\Task\AskAboutProjectParameters;
use BrightNucleus\Boilerplate\Scripts\Task\InitializeVCS;
use BrightNucleus\Boilerplate\Scripts\Task\MoveTemplateFilesToRootFolder;
use BrightNucleus\Boilerplate\Scripts\Task\RemoveConfigFolder;
use BrightNucleus\Boilerplate\Scripts\Task\RemoveExistingRootFiles;
use BrightNucleus\Boilerplate\Scripts\Task\RemoveOriginalVCSData;
use BrightNucleus\Boilerplate\Scripts\Task\RemoveTemplatesFolder;
use BrightNucleus\Boilerplate\Scripts\Task\RemoveVendorFolder;
use BrightNucleus\Boilerplate\Scripts\Task\ReplacePlaceholdersInTemplateFiles;
use BrightNucleus\Boilerplate\Scripts\Task\VerifyProjectParameters;
use BrightNucleus\Config\ConfigFactory;
use BrightNucleus\Config\ConfigInterface;
use Composer\Script\Event;

/**
 * Class Setup.
 *
 * @since   0.1.0
 *
 * @package BrightNucleus\Boilerplate\Scripts
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
class Setup
{

    /**
     * Run the setup, one task at a time.
     *
     * @since 0.1.0
     *
     * @param Event $event The Composer event that is being handled.
     */
    public static function run(Event $event)
    {
        $event->getIO()->write('<info>Now running setup tasks...</info>');
        $config = static::getConfig($event);
        $tasks  = static::getSetupTasks($event);
        foreach ($tasks as $task) {
            /** @var SetupTask $taskStep */
            $taskStep = new $task($config, $event);
            $event->getIO()->write(
                sprintf(
                    _('<info>Task %1$s</info>'),
                    $taskStep->getName()
                )
            );
            $taskStep->complete();
        }
        $event->getIO()->write('<info>Setup tasks complete, cleaning up...</info>');
    }

    /**
     * Get the key that is used in the `composer.json` file to pass extra information.
     *
     * @since 0.1.4
     *
     * @return string
     */
    protected static function getExtraKey()
    {
        return 'brightnucleus-boilerplate';
    }

    /**
     * Get the set of tasks to complete, in the correct order.
     *
     * @since 0.1.0
     *
     * @param Event $event The Composer event that is being handled.
     *
     * @return array Array of classes implementing the SetupTask interface.
     */
    protected static function getSetupTasks(Event $event)
    {
        return [
            AskAboutProjectParameters::class,
            VerifyProjectParameters::class,
            RemoveExistingRootFiles::class,
            ReplacePlaceholdersInTemplateFiles::class,
            MoveTemplateFilesToRootFolder::class,
            RemoveConfigFolder::class,
            RemoveTemplatesFolder::class,
            RemoveOriginalVCSData::class,
            InitializeVCS::class,

            // Removing the vendor folder also removes the autoloader,
            // so this task needs to run last.
            RemoveVendorFolder::class,
        ];
    }

    /**
     * Get the configuration file to use.
     *
     * @since 0.1.4
     *
     * @param Event $event The Composer event that is being handled.
     *
     * @return ConfigInterface Configuration file to use.
     */
    protected static function getConfig(Event $event)
    {
        $key   = static::getExtraKey();
        $extra = $event->getComposer()->getPackage()->getExtra();

        $configFile = isset($extra[$key])
                      && isset($extra[$key]['config-file'])
            ? $extra[$key]['config-file']
            : '_config/defaults.php';

        $configPrefix = isset($extra[$key])
                        && isset($extra[$key]['config-prefix'])
            ? $extra[$key]['config-prefix']
            : 'BrightNucleus/Boilerplate';

        return ConfigFactory::create(__DIR__ . '/../' . $configFile)
                            ->getSubConfig($configPrefix);
    }
}
