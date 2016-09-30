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

/**
 * Class VerifyProjectParameters.
 *
 * @since   0.1.0
 *
 * @package BrightNucleus\Boilerplate\Scripts\Task
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
class VerifyProjectParameters extends AbstractTask
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
        $this->io->write('<info>Summary :</info>');
        foreach ($this->getConfigKey('Placeholders') as $placeholder) {
            $this->io->write(
                sprintf(
                    '%1$s: <info>%2$s</info>',
                    $placeholder['name'],
                    $placeholder['value']
                )
            );
        }
    }
}
