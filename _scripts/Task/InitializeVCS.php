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

use BrightNucleus\Boilerplate\Scripts\SetupHelper;
use BrightNucleus\Exception\RuntimeException;

/**
 * Class InitializeVCS.
 *
 * @since   0.1.0
 *
 * @package BrightNucleus\Boilerplate\Scripts\Task
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
class InitializeVCS extends AbstractTask
{

    /**
     * Complete the setup task.
     *
     * @since 0.1.0
     *
     * @return void
     * @throws RuntimeException If the VCS could not be initialized.
     */
    public function complete()
    {
        $folder  = SetupHelper::getRootFolder();
        $command = sprintf(
            'cd %1$s && git init',
            escapeshellarg($folder)
        );

        exec($command, $output, $return);

        if (0 !== $return) {
            throw new RuntimeException(
                sprintf(
                    _('Could not initialize the VCS in folder "%1$s". [Exit Status: %2$d]'),
                    $folder,
                    $return
                )
            );
        }
    }
}
