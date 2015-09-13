<?php declare(strict_types=1);
/**
 * Email field
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

use CodeCollab\Form\Validation\Email as EmailValidator;

/**
 * Email field
 *
 * @category   CodeCollab
 * @package    Form
 * @subpackage Field
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Email extends Generic
{
    /**
     * Creates instance
     *
     * @param string                             $name            The name of the field
     * @param \CodeCollab\Validation\Validator[] $validationRules The validation rules
     * @param string                             $defaultValue    The default value
     */
    public function __construct(string $name, array $validationRules = [], $defaultValue = null)
    {
        $validationRules[] = new EmailValidator;

        parent::__construct($name, 'email', $validationRules, $defaultValue);
    }
}
