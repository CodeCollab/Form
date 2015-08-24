<?php declare(strict_types=1);
/**
 * Interface for forms
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

use CodeCollab\Http\Request\Request;
use CodeCollab\Form\Fieldset;

/**
 * Interface for forms
 *
 * @category   CodeCollab
 * @package    Form
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
interface Form
{
    /**
     * Binds the request to the form
     *
     * @param \CodeCollab\Http\Request\Request $request The request object
     */
    public function bindRequest(Request $request);

    /**
     * Checks whether the form is valid
     *
     * @return bool True when the form is valid
     */
    public function isValid(): bool;

    /**
     * Gets the fieldset of the form
     *
     * @return \CodeCollab\Form\Fieldset The fieldset
     */
    public function getFieldset(): Fieldset;
}
