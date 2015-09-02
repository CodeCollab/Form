<?php declare(strict_types=1);
/**
 * Email field validator
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
 * Email field validator
 *
 * @category   CodeCollab
 * @package    Form
 * @subpackage Validation
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Email extends Generic
{
    /**
     * Validates a form field value
     */
    public function validate(string $value)
    {
        if (!$value || filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return;
        }

        $this->error['type.email'] = [];
    }
}
