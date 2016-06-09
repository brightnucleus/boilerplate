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
 * Class DisplayBoilerplateLogo.
 *
 * This is only an example task used in the documentation.
 * It is not hooked up to the system by default.
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
