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
    private $csrfToken;

    /**
     * @var \CodeCollab\Form\Fieldset The field set of this form
     */
    protected $fieldset;

    /**
     * @var \CodeCollab\Http\Request\Request The HTTP request
     */
    protected $request;

    /**
     * Creates instance
     *
     * @param \CodeCollab\CsrfToken\Token $csrfToken The CSRF token handler
     * @param \CodeCollab\Form\Fieldset   $fieldset  The field set of this form
     */
    public function __construct(Token $csrfToken, Fieldset $fieldset)
    {
        $this->csrfToken = $csrfToken;
        $this->fieldset  = $fieldset;

        $this->setupFields();
    }

    /**
     * Sets up the fields of the form
     */
    abstract protected function setupFields();

    /**
     * Binds the request to the form
     *
     * @param \CodeCollab\Http\request\Request $request The request object
     */
    public function bindRequest(Request $request)
    {
        $this->request = $request;

        $this->fieldset->bindRequest($request);
    }

    /**
     * Checks whether the form is valid
     *
     * @return bool True when the form is valid
     */
    public function isValid(): bool
    {
        if (!$this->csrfToken->validate(base64_decode($this->request->get('csrf-token')))) {
            return false;
        }

        return $this->fieldset->isValid();
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
        return $this->fieldset->exists($offset);
    }

    /**
     * Gets a field if it exists
     *
     * @param mixed $offset Offset to retrieve
     *
     * @return null|\CodeCollab\Form\Field The field if it exists
     */
    public function offsetGet($offset)
    {
        if (!$this->offsetExists($offset)) {
            return null;
        }

        return $this->fieldset->getField($offset);
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
     * @return \CodeCollab\Form\Fieldset The fieldset
     */
    public function getFieldset(): Fieldset
    {
        return $this->fieldset;
    }
}
