<?php declare(strict_types=1);
/**
 * Max field validator
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
 * Max field validator
 *
 * @category   CodeCollab
 * @package    Form
 * @subpackage Validation
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Max extends Generic
{
    /**
     * @var float The maximum allowed value
     */
    private $maximumValue;

    /**
     * Creates instance
     *
     * @param float $maximumValue The maximum allowed value
     */
    public function __construct(float $maximumValue)
    {
        $this->maximumValue = $maximumValue;
    }

    /**
     * Validates a form field value
     *
     * @param string $value The value to validate
     */
    public function validate(string $value)
    {
        if (!$value || $value <= $this->maximumValue) {
            return;
        }

        $this->error['max.%'] = [$this->maximumValue];
    }
}
