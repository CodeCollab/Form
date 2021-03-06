<?php declare(strict_types=1);
/**
 * Textarea field
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
 * Textarea field
 *
 * @category   CodeCollab
 * @package    Form
 * @subpackage Field
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Textarea extends Generic
{
    /**
     * Creates instance
     *
     * @param string                                  $name            The name of the field
     * @param \CodeCollab\Form\Validation\Validator[] $validationRules The validation rules
     * @param string                                  $defaultValue    The default value
     */
    public function __construct(string $name, array $validationRules = [], $defaultValue = null)
    {
        parent::__construct($name, 'textarea', $validationRules, $defaultValue);
    }
}
