<?php declare(strict_types=1);
/**
 * Select field
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
 * Select field
 *
 * @category   CodeCollab
 * @package    Form
 * @subpackage Field
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Select extends Generic
{
    /**
     * Creates instance
     *
     * @param string                             $name            The name of the field
     * @param \CodeCollab\Validation\Validator[] $validationRules The validation rules
     */
    public function __construct(string $name, array $validationRules = [])
    {
        parent::__construct($name, 'select', $validationRules);
    }
}
