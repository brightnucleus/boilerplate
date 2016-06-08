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
use Composer\Util\Filesystem;
use Symfony\Component\Finder\Finder;

/**
 * Class MoveTemplateFilesToRootFolder.
 *
 * @since   0.1.0
 *
 * @package BrightNucleus\Boilerplate\Scripts\Task
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
class MoveTemplateFilesToRootFolder extends AbstractTask
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
        $filesystem      = new Filesystem();
        $templatesFolder = $this->getConfigKey('Folders', 'templates');
        $finder          = new Finder();
        foreach ($finder->files()->in($templatesFolder) as $file) {
            $from = $file->getPathname();
            $to   = $this->getTargetPath($from);
            $filesystem->ensureDirectoryExists(dirname($to));
            $filesystem->copyThenRemove($from, $to);
        }
    }

    /**
     * Get the target path for a rendered file from a template file.
     *
     * @since 0.1.0
     *
     * @param string $pathname The path and file name to the template file.
     *
     * @return string The target path and file name to use for the rendered file.
     */
    protected function getTargetPath($pathname)
    {
        $filesystem      = new Filesystem();
        $templatesFolder = $this->getConfigKey('Folders', 'templates');
        $folderDiff      = '/' . $filesystem->findShortestPath(
                SetupHelper::getRootFolder(),
                $templatesFolder
            );

        return (string)$this->removeTemplateExtension(str_replace($folderDiff, '', $pathname));
    }

    /**
     * Remove the template file extension form a path.
     *
     * @since 0.1.0
     *
     * @param string $pathname The path and file name to remove the template extension from.
     *
     * @return string The path and file name minus the template extension.
     */
    protected function removeTemplateExtension($pathname)
    {
        return (string)str_replace($this->getConfigKey('TemplateExtension'), '', $pathname);
    }
}
