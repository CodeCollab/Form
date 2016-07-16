<?php declare(strict_types=1);
/**
 * Interface for form field validators
 *
 * PHP version 7.0
 *
 * @category   CodeCollab
 * @package    Form
 * @subpackage Validation
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2015 Pieter Hordijk <https://github.com/PeeHaa>
 * @license    See the LICENSE file
 * @version    1.0.0
 */
namespace CodeCollab\Form\Validation;

/**
 * Interface for form field validators
 *
 * @category   CodeCollab
 * @package    Form
 * @subpackage Validation
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
interface Validator
{
    /**
     * Validates a form field value
     *
     * @param string $value The value
     */
    public function validate(string $value);

    /**
     * Checks whether the field value is valid
     *
     * @return bool True when the field value is valid
     */
    public function isValid(): bool;

    /**
     * Gets the error (if any)
     *
     * @return array An array with the (translation ready) error message as key and the value containing the error
     *               information. The error information can be an empty array (e.g. required validation failed),
     *               a single item (e.g. minimum value validation failed) or multi items (e.g. range validation failed)
     */
    public function getError(): array;
}
