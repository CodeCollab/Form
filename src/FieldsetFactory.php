<?php declare(strict_types=1);
/**
 * Factory for fieldsets
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
 * Factory for fieldsets
 *
 * @category   CodeCollab
 * @package    Form
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class FieldsetFactory
{
    /**
     * @var \CodeCollab\Form\FieldFactory Factory which builds fields
     */
    private $fieldFactory;

    /**
     * Creates instance
     *
     * @param \CodeCollab\Form\FieldFactory $fieldFactory Factory which builds fields
     */
    public function __construct(FieldFactory $fieldFactory)
    {
        $this->fieldFactory = $fieldFactory;
    }

    /**
     * Builds the fieldset
     *
     * @return \CodeCollab\Form\Fieldset The built field set
     */
    public function build(): Fieldset
    {
        return new Fieldset($this->fieldFactory);
    }
}
