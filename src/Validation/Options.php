<?php declare(strict_types=1);
/**
 * Options validator
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
 * Options validator
 *
 * @category   CodeCollab
 * @package    Form
 * @subpackage Validation
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Options extends Generic
{
    /**
     * @var array The values to match against
     */
    private $values = [];

    /**
     * Creates instance
     *
     * @param array $values The values to match against
     */
    public function __construct(array $values)
    {
        $this->values = $values;
    }

    /**
     * Validates a form field value
     *
     * @param string $value The value
     */
    public function validate(string $value)
    {
        if (!$value || in_array($value, $this->values, true)) {
            return;
        }

        $this->error['options'] = [$this->values];
    }
}
