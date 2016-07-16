<?php declare(strict_types=1);
/**
 * Required field validator
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
 * Required field validator
 *
 * @category   CodeCollab
 * @package    Form
 * @subpackage Validation
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Required extends Generic
{
    /**
     * Validates a form field value
     *
     * @param string $value The value
     */
    public function validate(string $value)
    {
        if ($value) {
            return;
        }

        $this->error['required'] = [];
    }
}
