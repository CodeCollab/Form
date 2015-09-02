<?php declare(strict_types=1);
/**
 * Password field
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
 * Password field
 *
 * @category   CodeCollab
 * @package    Form
 * @subpackage Field
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Password extends Generic
{
    /**
     * Creates instance
     *
     * @param string                             $name            The name of the field
     * @param \CodeCollab\Validation\Validator[] $validationRules The validation rules
     */
    public function __construct(string $name, array $validationRules = [])
    {
        parent::__construct($name, 'password', $validationRules);
    }
}
