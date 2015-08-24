<?php declare(strict_types=1);
/**
 * Exception which gets thrown when trying to set a form field from outside a form class
 *
 * PHP version 7.0
 *
 * @category   CodeCollab
 * @package    Form
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2015 Pieter Hordijk <https://github.com/PeeHaa>
 * @license    See the LICENSE file
 * @version    1.0.0
 */
namespace CodeCollab\Form;

/**
 * Exception which gets thrown when trying to set a form field from outside a form class
 *
 * @category   CodeCollab
 * @package    Form
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class OutOfScopeException extends \Exception
{
}
