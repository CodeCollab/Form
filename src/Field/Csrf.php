<?php declare(strict_types=1);
/**
 * CSRF field
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
 * CSRF field
 *
 * @category   CodeCollab
 * @package    Form
 * @subpackage Field
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Csrf extends Generic
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
        parent::__construct($name, 'csrf', $validationRules, $defaultValue);
    }

    /**
     * Gets the field's value
     *
     * @return string The value
     */
    public function getValue(): string
    {
        if ($this->defaultValue === null) {
            return '';
        }

        return $this->defaultValue;
    }

    /**
     * Validates the field
     */
    public function validate()
    {
        foreach ($this->validationRules as $rule) {
            // validate using the user supplied value only
            $rule->validate($this->value);

            if (!$rule->isValid()) {
                $this->errors += $rule->getError();
            }
        }

        $this->validated = true;
    }
}
