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

use BrightNucleus\Exception\InvalidArgumentException;

/**
 * Class Validation.
 *
 * @since   0.1.0
 *
 * @package BrightNucleus\Boilerplate\Scripts
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
class Validation
{

    /**
     * Verify that a string is in PascalCase or throw an Exception.
     *
     * @since 0.1.0
     *
     * @param string $string The string to validate.
     *
     * @return string The validated string.
     * @throws InvalidArgumentException If the string is not in PascalCase.
     */
    public static function validatePascalCase($string)
    {
        if (SetupHelper::getPascalCase($string) === $string) {
            return (string)$string;
        }

        throw new InvalidArgumentException(
            sprintf(
                _('Provided string "%1$s" was not in PascalCase.'),
                $string
            )
        );
    }

    /**
     * Verify that a string is in lowercase or throw an Exception.
     *
     * @since 0.1.0
     *
     * @param string $string The string to validate.
     *
     * @return string The validated string.
     * @throws InvalidArgumentException If the string is not in lowercase.
     */
    public static function validateLowerCase($string)
    {
        if (SetupHelper::getLowerCase($string) === $string) {
            return (string)$string;
        }

        throw new InvalidArgumentException(
            sprintf(
                _('Provided string "%1$s" was not in lowercase.'),
                $string
            )
        );
    }

    /**
     * Verify that a string is trimmed or throw an Exception.
     *
     * @since 0.1.0
     *
     * @param string $string The string to validate.
     *
     * @return string The validated string.
     * @throws InvalidArgumentException If the string is not trimmed.
     */
    public static function validateTrimmed($string)
    {
        if (SetupHelper::trim($string) === $string) {
            return (string)$string;
        }

        throw new InvalidArgumentException(
            sprintf(
                _('Provided string "%1$s" was not trimmed.'),
                $string
            )
        );
    }

    /**
     * Verify that a string is an email or throw an Exception.
     *
     * @since 0.1.0
     *
     * @param string $string The string to validate.
     *
     * @return string The validated string.
     * @throws InvalidArgumentException If the string is not an email.
     */
    public static function validateEmail($string)
    {
        if (filter_var($string, FILTER_VALIDATE_EMAIL)) {
            return (string)$string;
        }

        throw new InvalidArgumentException(
            sprintf(
                _('Provided string "%1$s" was not a valid email.'),
                $string
            )
        );
    }

    /**
     * Verify that a string is a URL or throw an Exception.
     *
     * @since 0.1.0
     *
     * @param string $string The string to validate.
     *
     * @return string The validated string.
     * @throws InvalidArgumentException If the string is not a URL.
     */
    public static function validateURL($string)
    {
        if (filter_var($string, FILTER_VALIDATE_URL)) {
            return (string)$string;
        }

        throw new InvalidArgumentException(
            sprintf(
                _('Provided string "%1$s" was not a valid URL.'),
                $string
            )
        );
    }

    /**
     * Verify that a string is a year or year range or throw an Exception.
     *
     * @since 0.1.0
     *
     * @param string $string The string to validate.
     *
     * @return string The validated string.
     * @throws InvalidArgumentException If the string is not a year or year range.
     */
    public static function validateYear($string)
    {
        if (preg_match('/^([0-9]{4})(?:\s?[-|,]\s?([0-9]{4}))?$/', $string)) {
            return (string)$string;
        }

        throw new InvalidArgumentException(
            sprintf(
                _('Provided string "%1$s" was not a valid year or year range.'),
                $string
            )
        );
    }

    /**
     * Verify that a string is a date or throw an Exception.
     *
     * @since 0.1.0
     *
     * @param string $string The string to validate.
     *
     * @return string The validated string.
     * @throws InvalidArgumentException If the string is not a date.
     */
    public static function validateDate($string)
    {
        if (strtotime($string)) {
            return (string)$string;
        }

        throw new InvalidArgumentException(
            sprintf(
                _('Provided string "%1$s" was not a valid date.'),
                $string
            )
        );
    }
}
