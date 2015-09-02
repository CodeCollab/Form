<?php declare(strict_types=1);
/**
 * Generic field validator
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
 * Generic field validator
 *
 * @category   CodeCollab
 * @package    Form
 * @subpackage Validation
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
abstract class Generic implements Validator
{
    /**
     * @var array The error when the validation failed
     */
    protected $error = [];

    /**
     * Checks whether the field value is valid
     *
     * @return bool True when the field value is valid
     */
    public function isValid(): bool
    {
        return !(bool) $this->error;
    }

    /**
     * Gets the error (if any)
     *
     * @return array An array with the (translation ready) error message as key and the value containing the error
     *               information. The error information can be an empty array (e.g. required validation failed),
     *               a single item (e.g. minimum value validation failed) or multi items (e.g. range validation failed)
     */
    public function getError(): array
    {
        return $this->error;
    }
}
