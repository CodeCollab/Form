<?php declare(strict_types=1);
/**
 * Regex field validator
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
 * Regex field validator
 *
 * @category   CodeCollab
 * @package    Form
 * @subpackage Validation
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Regex extends Generic
{
    /**
     * @var string The pattern to match against
     */
    private $pattern;

    /**
     * Creates instance
     *
     * @param string $pattern  The pattern to match against
     */
    public function __construct(string $pattern)
    {
        $this->pattern = $pattern;
    }

    /**
     * Validates a form field value
     *
     * @param string $value The value
     */
    public function validate(string $value)
    {
        if (!$value || preg_match($this->pattern, $value)) {
            return;
        }

        $this->error['regex'] = [];
    }
}
