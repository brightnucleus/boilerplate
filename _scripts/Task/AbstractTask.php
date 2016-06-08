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

namespace BrightNucleus\Boilerplate\Scripts\Task;

use BrightNucleus\Boilerplate\Scripts\SetupTask;
use BrightNucleus\Config\ConfigInterface;
use BrightNucleus\Config\ConfigTrait;
use BrightNucleus\Config\Exception\FailedToProcessConfigException;
use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Script\Event;

/**
 * Class AbstractTask.
 *
 * @since   0.1.0
 *
 * @package BrightNucleus\Boilerplate\Scripts\Task
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
abstract class AbstractTask implements SetupTask
{

    use ConfigTrait;

    /**
     * Composer Event Object that is being handled.
     *
     * @since 0.1.0
     *
     * @var Event
     */
    protected $event;

    /**
     * Name of the event that is being handled.
     *
     * @since 0.1.0
     *
     * @var string
     */
    protected $name;

    /**
     * Arguments of the event that is being handled.
     *
     * @since 0.1.0
     *
     * @var array
     */
    protected $arguments;

    /**
     * Flags of the event tat is being handled.
     *
     * @since 0.1.0
     *
     * @var array
     */
    protected $flags;

    /**
     * Composer instance.
     *
     * @since 0.1.0
     *
     * @var Composer
     */
    protected $composer;

    /**
     * Input/Output interface instance.
     *
     * @since 0.1.0
     *
     * @var IOInterface
     */
    protected $io;

    /**
     * Instantiate an AbstractTask object.
     *
     * @since 0.1.0
     *
     * @param ConfigInterface $config Configuration settings.
     * @param Event           $event  The Composer Event that is being handled.
     *
     * @throws FailedToProcessConfigException If the configuration could not be processed.
     */
    public function __construct(ConfigInterface $config, Event $event)
    {
        $this->processConfig($config);
        $this->event     = $event;
        $this->name      = $event->getName();
        $this->arguments = $event->getArguments();
        $this->flags     = $event->getFlags();
        $this->composer  = $event->getComposer();
        $this->io        = $event->getIO();
    }

    /**
     * Get the name of the current task.
     *
     * @since 0.1.0
     *
     * @return string Name of the task.
     */
    public function getName()
    {
        return substr(strrchr(get_class($this), '\\'), 1);
    }
}
