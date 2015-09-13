<?php declare(strict_types=1);
/**
 * Base form. All forms should inherit from this class
 *
 * PHP version 7.0
 *
 * @category   CodeCollab
 * @package    Form
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2015 Pieter Hordijk <https://github.com/PeeHaa>
 * @license    See the LICENSE file
 * @version    1.0.0
 */
namespace CodeCollab\Form;

use CodeCollab\CsrfToken\Token;
use CodeCollab\Http\Request\Request;
use CodeCollab\Form\Field\Field;

/**
 * Base form. All forms should inherit from this class
 *
 * @category   CodeCollab
 * @package    Form
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
abstract class BaseForm implements Form, \ArrayAccess
{
    /**
     * @var \CodeCollab\CsrfToken\Token The CSRF token handler
     */
    protected $csrfToken;

    /**
     * @var \CodeCollab\Form\Field\Field[] List of fields in teh form
     */
    protected $fieldset = [];

    /**
     * @var \CodeCollab\Http\Request\Request The HTTP request
     */
    protected $request;

    /**
     * @var bool Whether the form has already been validated
     */
    protected $validated = false;

    /**
     * Creates instance
     *
     * @param \CodeCollab\CsrfToken\Token $csrfToken The CSRF token handler
     */
    public function __construct(Token $csrfToken)
    {
        $this->csrfToken = $csrfToken;

        $this->setupFields();
    }

    /**
     * Sets up the fields of the form
     */
    abstract protected function setupFields();

    /**
     * Adds a field to the collection
     *
     * @param \CodeCollab\Form\Field\Field $field The field to add
     */
    protected function addField(Field $field)
    {
        $this->fieldset[$field->getName()] = $field;
    }

    /**
     * Binds the request to the form
     *
     * @param \CodeCollab\Http\Request\Request $request The request object
     */
    public function bindRequest(Request $request)
    {
        $this->request = $request;

        foreach ($this->request->postArray() as $key => $value) {
            if (isset($this->fieldset[$key])) {
                $this->fieldset[$key]->setValue($value);
            }
        }
    }

    /**
     * Checks whether the form has been validated
     *
     * @return bool True when the form has been validated
     */
    public function isValidated(): bool
    {
        return $this->validated;
    }

    /**
     * Checks whether the form is valid
     *
     * @return bool True when the form is valid
     */
    public function isValid(): bool
    {
        $valid = true;

        foreach ($this->fieldset as $name => $field) {
            $field->validate();

            if (!$field->isValid()) {
                $valid = false;
            }
        }

        $this->validated = true;

        return $valid;
    }

    /**
     * Checks whether an offset exists
     *
     * @param mixed $offset An offset to check for
     *
     * @return bool True when the offset exists
     */
    public function offsetExists($offset): bool
    {
        return isset($this->fieldset[$offset]);
    }

    /**
     * Gets a field if it exists
     *
     * @param mixed $offset Offset to retrieve
     *
     * @return null|\CodeCollab\Form\Field\Field The field if it exists
     */
    public function offsetGet($offset)
    {
        if (!$this->offsetExists($offset)) {
            return null;
        }

        return $this->fieldset[$offset];
    }

    /**
     * Sets a field
     *
     * Because all the fields are build in the parent class it is not possible to set a field from some other scope.
     * We are throwing up here the user doing this and introducing maintenance nightmares
     *
     * @param mixed $offset The offset to assign the value to
     * @param mixed $value  The value to set
     *
     * @throws \CodeCollab\Form\OufOfScopeException When trying to use this method
     */
    public function offsetSet($offset, $value)
    {
        throw new OutOfScopeException();
    }

    /**
     * Unsets a field
     *
     * Because all the fields are build in the parent class it is not possible to unset a field from some other scope.
     * We are throwing up here the user doing this and introducing maintenance nightmares
     *
     * @param mixed $offset The offset to unset
     *
     * @throws \CodeCollab\Form\OufOfScopeException When trying to use this method
     */
    public function offsetUnset($offset)
    {
        throw new OutOfScopeException();
    }

    /**
     * Gets the fieldset of the form
     *
     * @return array The fieldset
     */
    public function getFieldset(): array
    {
        return $this->fieldset;
    }
}
