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

/**
 * Interface SetupTask.
 *
 * Each individual setup task will need to implement this interface.
 *
 * @since   0.1.0
 *
 * @package BrightNucleus\Boilerplate\Scripts
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
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
