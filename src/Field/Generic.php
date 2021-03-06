<?php declare(strict_types=1);
/**
 * Generic field
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

use CodeCollab\Form\Validation\Required;

/**
 * Generic field
 *
 * @category   CodeCollab
 * @package    Form
 * @subpackage Field
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
abstract class Generic implements Field
{
    /**
     * @var string The name of the field
     */
    protected $name;

    /**
     * @var string The type of the field
     */
    protected $type;

    /**
     * @var array List of validation rules
     */
    protected $validationRules;

    /**
     * @var string The default value of the field
     */
    protected $defaultValue = null;

    /**
     * @var bool Whether the field has been validated yet
     */
    protected $validated = false;

    /**
     * @var array List of validation errors
     */
    protected $errors = [];

    /**
     * @var string The value of the field
     */
    protected $value = null;

    /**
     * Creates instance
     *
     * @param string                                  $name The name of the field
     * @param string                                  $type The type of the field
     * @param \CodeCollab\Form\Validation\Validator[] $validationRules The validation rules
     * @param string                                  $defaultValue    The default value
     */
    public function __construct(string $name, string $type, array $validationRules = [], $defaultValue = null)
    {
        $this->name            = $name;
        $this->type            = $type;
        $this->validationRules = $validationRules;
        $this->defaultValue    = $defaultValue;
    }

    /**
     * Gets the name of the field
     *
     * @return string The name of the field
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Gets the type of the field
     *
     * @return string The type of the field
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Gets the default value of the field
     *
     * @return string The default value of the field
     */
    public function getDefaultValue(): string
    {
        return $this->defaultValue ?? '';
    }

    /**
     * Checks whether the field is required
     *
     * @return bool True when the field is required
     */
    public function isRequired(): bool
    {
        foreach ($this->validationRules as $rule) {
            if ($rule instanceof Required) {
                return true;
            }
        }

        return false;
    }

    /**
     * Sets the field's value
     *
     * @param string $value The value
     */
    public function setValue(string $value)
    {
        $this->value = $value;
    }

    /**
     * Gets the field's value
     *
     * @return string The value
     */
    public function getValue(): string
    {
        if (!$this->validated && $this->defaultValue !== null) {
            return $this->defaultValue;
        }

        if ($this->value === null) {
            return '';
        }

        return $this->value;
    }

    /**
     * Validates the field
     */
    public function validate()
    {
        foreach ($this->validationRules as $rule) {
            $rule->validate($this->getValue());

            if (!$rule->isValid()) {
                $this->errors += $rule->getError();
            }
        }

        $this->validated = true;
    }

    /**
     * Invalidates the field
     *
     * Useful when there is a need to do custom field validation. E.g. from inside a form
     *
     * @param string $type The error type
     * @param array  $data The (optional) extra data of the error
     */
    public function invalidate(string $type, array $data = [])
    {
        $this->errors += [$type => $data];
    }

    /**
     * Checks whether there were validation errors
     *
     * @return bool True when there were validation errors
     */
    public function isValid(): bool
    {
        return empty($this->errors);
    }

    /**
     * Gets the error type
     *
     * @return string The error type
     */
    public function getErrorType(): string
    {
        if ($this->isValid()) {
            return '';
        }

        return key($this->errors);
    }

    /**
     * Gets the error data
     *
     * @return array The error data
     */
    public function getErrorData(): array
    {
        if ($this->isValid()) {
            return [];
        }

        return reset($this->errors);
    }
}
