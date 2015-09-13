<?php declare(strict_types=1);

namespace CodeCollabTest\Unit\Form\Field;

use CodeCollab\Form\Field\Checkbox;

class CheckboxTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers CodeCollab\Form\Field\Checkbox::__construct
     */
    public function testImplementsCorrectInterface()
    {
        $field = new Checkbox('checkboxfield');

        $this->assertInstanceOf('CodeCollab\Form\Field\Field', $field);
        $this->assertSame('checkboxfield', $field->getName());
        $this->assertSame('checkbox', $field->getType());
    }


    /**
     * @covers CodeCollab\Form\Field\Checkbox::__construct
     * @covers CodeCollab\Form\Field\Checkbox::getValue
     */
    public function testGetValueEmptyStringWhenNoDefaultValueIsSupplied()
    {
        $field = new Checkbox('checkboxfield');

        $this->assertSame('', $field->getValue());
    }

    /**
     * @covers CodeCollab\Form\Field\Checkbox::__construct
     * @covers CodeCollab\Form\Field\Checkbox::getValue
     */
    public function testGetValueReturnsDefaultValueEvenWhenValueIsManuallySet()
    {
        $field = new Checkbox('checkboxfield', [], 'defaultvalue');

        $field->setValue('custom value');

        $this->assertSame('defaultvalue', $field->getValue());
    }
}
