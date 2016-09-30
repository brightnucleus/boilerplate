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

use BrightNucleus\Exception\RuntimeException;
use Composer\Util\Filesystem;

/**
 * Class SetupHelper.
 *
 * @since   0.1.0
 *
 * @package BrightNucleus\Boilerplate\Scripts
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
class SetupHelper
{

    /**
     * Trim whitespace and control characters from beginning and end of string.
     *
     * @since 0.1.0
     *
     * @param $string String to trim.
     *
     * @return string Trimmed string.
     */
    public static function trim($string)
    {
        return (string)\trim($string);
    }

    /**
     * Strip the spaces from a string.
     *
     * @since 0.1.0
     *
     * @param $string String to strip the spaces from.
     *
     * @return string String without spaces.
     */
    public static function stripSpaces($string)
    {
        return (string)str_replace(' ', '', static::trim($string));
    }

    /**
     * Convert string into PascalCase.
     *
     * @since 0.1.0
     *
     * @param $string String to convert into PascalCase.
     *
     * @return string Converted string.
     */
    public static function getPascalCase($string)
    {
        return (string)static::stripSpaces(ucwords(static::trim($string)));
    }

    /**
     * Convert string into lowercase.
     *
     * @since 0.1.0
     *
     * @param string $string String to convert into lowercase.
     *
     * @return string Converted string.
     */
    public static function getLowerCase($string)
    {
        return (string)static::stripSpaces(strtolower(static::trim($string)));
    }

    /**
     * Get a folder path from a project-root-relative folder name.
     *
     * @since 0.1.0
     *
     * @param string $folderName Project-root-relative folder name to get the path of.
     *
     * @return string Complete path to the requested folder.
     * @throws RuntimeException If the folder could not be matched.
     */
    public static function getFolder($folderName)
    {
        return static::getRootFolder() . '/' . $folderName;
    }

    /**
     * Get the path to the package's root folder.
     *
     * @since 0.1.0
     *
     * @return string Complete path to the root folder.
     * @throws RuntimeException If the folder could not be matched.
     */
    public static function getRootFolder()
    {
        $filesystem = new Filesystem();
        $folder     = $filesystem->normalizePath(__DIR__ . '/../');

        if (! is_dir($folder)) {
            throw new RuntimeException(
                sprintf(
                    'Could not find a matching folder for folder name "%1$s".',
                    $folder
                )
            );
        }

        return $folder;
    }

    /**
     * Get a file path from a project-root-relative file name.
     *
     * @since 0.1.0
     *
     * @param string $fileName Project-root-relative file name to get the path of.
     *
     * @return string Complete path to the requested file.
     * @throws RuntimeException If the file could not be matched.
     */
    public static function getFile($fileName)
    {
        $filesystem = new Filesystem();
        $file       = $filesystem->normalizePath(__DIR__ . '/../' . $fileName);

        if (! file_exists($file)) {
            throw new RuntimeException(
                sprintf(
                    'Could not find a matching file for file name "%1$s".',
                    $fileName
                )
            );
        }

        return $file;
    }
}
