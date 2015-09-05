<?php declare(strict_types=1);
/**
 * Match field validator
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
 * Match field validator
 *
 * @category   CodeCollab
 * @package    Form
 * @subpackage Validation
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Match extends Generic
{
    /**
     * @var string The value to match against
     */
    private $value;

    /**
     * Creates instance
     *
     * @param string $value The value to match against
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * Validates a form field value
     */
    public function validate(string $value)
    {
        if (!$value || $this->value === $value) {
            return;
        }

        $this->error['match'] = [$this->value];
    }
}
