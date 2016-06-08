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

use Mustache_Engine;
use Symfony\Component\Finder\Finder;

/**
 * Class ReplacePlaceholdersInTemplateFiles.
 *
 * @since   0.1.0
 *
 * @package BrightNucleus\Boilerplate\Scripts\Task
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
class ReplacePlaceholdersInTemplateFiles extends AbstractTask
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
        $placeholders    = $this->getPlaceholderArray();
        $templatesFolder = $this->getConfigKey('Folders', 'templates');
        $finder          = new Finder();
        foreach ($finder->files()->in($templatesFolder) as $file) {
            $template = file_get_contents($file);
            $mustache = new Mustache_Engine();
            $result   = $mustache->render($template, $placeholders);
            file_put_contents($file, $result);
        }
    }

    /**
     * Get an array of placeholder => value combinations to be used by Mustache.
     *
     * @since 0.1.0
     *
     * @return array Array of placeholder => value combinations.
     */
    protected function getPlaceholderArray()
    {
        $placeholderArray = [];
        foreach ($this->getConfigKey('Placeholders') as $key => $data) {
            $placeholderArray[$key] = $data['value'];
        }

        return $placeholderArray;
    }
}
