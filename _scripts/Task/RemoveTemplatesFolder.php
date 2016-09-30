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

use Composer\Util\Filesystem;
use Exception;

/**
 * Class RemoveTemplatesFolder.
 *
 * @since   0.1.0
 *
 * @package BrightNucleus\Boilerplate\Scripts\Task
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
class RemoveTemplatesFolder extends AbstractTask
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
        $templatesFolder = $this->getConfigKey('Folders', 'templates');
        try {
            $filesystem = new Filesystem();
            $filesystem->removeDirectory($templatesFolder);
        } catch (Exception $exception) {
            $this->io->writeError(
                sprintf(
                    'Could not remove templates folder "%1$s". Reason: %2$s',
                    $templatesFolder,
                    $exception->getMessage()
                )
            );
        }
    }
}
