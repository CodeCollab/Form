<?php declare(strict_types=1);
/**
 * Max length field validator
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
 * Max length field validator
 *
 * @category   CodeCollab
 * @package    Form
 * @subpackage Validation
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class MaxLength extends Generic
{
    /**
     * @var int The maximum allowed length
     */
    private $maximumLength;

    /**
     * Creates instance
     *
     * @param int $maximumLength The maximum allowed length
     */
    public function __construct(int $maximumLength)
    {
        $this->maximumLength = $maximumLength;
    }

    /**
     * Validates a form field value
     *
     * @param string $value The value to validate
     */
    public function validate(string $value)
    {
        if (!$value || mb_strlen($value, 'UTF-8') <= $this->maximumLength) {
            return;
        }

        $this->error['maxlength.%'] = [$this->maximumLength];
    }
}
