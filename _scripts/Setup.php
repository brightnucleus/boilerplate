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
use BrightNucleus\Boilerplate\Scripts\Task\MoveTemplateFilesToRootFolder;
use BrightNucleus\Boilerplate\Scripts\Task\RemoveConfigFolder;
use BrightNucleus\Boilerplate\Scripts\Task\RemoveExistingRootFiles;
use BrightNucleus\Boilerplate\Scripts\Task\RemoveTemplatesFolder;
use BrightNucleus\Boilerplate\Scripts\Task\RemoveVendorFolder;
use BrightNucleus\Boilerplate\Scripts\Task\ReplacePlaceholdersInTemplateFiles;
use BrightNucleus\Boilerplate\Scripts\Task\VerifyProjectParameters;
use BrightNucleus\Config\ConfigFactory;
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
        $config = ConfigFactory::create(__DIR__ . '/../_config/defaults.php')
                               ->getSubConfig('BrightNucleus\Boilerplate');
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
        ];
    }
}
