<?php declare(strict_types=1);
/**
 * Form field interface
 *
 * PHP version 7.0
 *
 * @category   CodeCollab
 * @package    Form
 * @subpackage Field
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2015 Pieter Hordijk <https://github.com/PeeHaa>
 * @license    See the LICENSE file
 * @version    1.0.0
 */
namespace CodeCollab\Form\Field;

/**
 * Form field interface
 *
 * @category   CodeCollab
 * @package    Form
 * @subpackage Field
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
interface Field
{
    /**
     * Gets the name of the field
     *
     * @return string The name of the field
     */
    public function getName(): string;

    /**
     * Gets the type of the field
     *
     * @return string The type of the field
     */
    public function getType(): string;

    /**
     * Checks whether the field is required
     *
     * @return bool True when the field is required
     */
    public function isRequired(): bool;

    /**
     * Sets the field's value
     *
     * @param string $value The value
     */
    public function setValue(string $value);

    /**
     * Gets the field's value
     *
     * @return string The value
     */
    public function getValue(): string;

    /**
     * Validates the field
     */
    public function validate();

    /**
     * Checks whether there were validation errors
     *
     * @return bool True when there were validation errors
     */
    public function isValid(): bool;

    /**
     * Gets the error type
     *
     * @return string The error type
     */
    public function getErrorType(): string;

    /**
     * Gets the error data
     *
     * @return array The error data
     */
    public function getErrorData(): array;
}
