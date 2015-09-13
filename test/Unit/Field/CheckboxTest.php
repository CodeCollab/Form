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
}
