<?php declare(strict_types=1);
/**
 * Min field validator
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
 * Min field validator
 *
 * @category   CodeCollab
 * @package    Form
 * @subpackage Validation
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Min extends Generic
{
    /**
     * @var float The minimum allowed value
     */
    private $minimumValue;

    /**
     * Creates instance
     *
     * @param float $minimumValue The minimum allowed value
     */
    public function __construct(float $minimumValue)
    {
        $this->minimumValue = $minimumValue;
    }

    /**
     * Validates a form field value
     *
     * @param string $value The value to validate
     */
    public function validate(string $value)
    {
        if (!$value || $value >= $this->minimumValue) {
            return;
        }

        $this->error['min.%'] = [$this->minimumValue];
    }
}
