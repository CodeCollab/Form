<?php declare(strict_types=1);
/**
 * Min length field validator
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
 * Min length field validator
 *
 * @category   CodeCollab
 * @package    Form
 * @subpackage Validation
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class MinLength extends Generic
{
    /**
     * @var int The minimum allowed length
     */
    private $minimumLength;

    /**
     * Creates instance
     *
     * @param int $minimumLength The minimum allowed length
     */
    public function __construct(int $minimumLength)
    {
        $this->minimumLength = $minimumLength;
    }

    /**
     * Validates a form field value
     */
    public function validate(string $value)
    {
        if (!$value || mb_strlen($value, 'UTF-8') >= $this->minimumLength) {
            return;
        }

        $this->error['minlength'] = [$this->minimumLength];
    }
}
