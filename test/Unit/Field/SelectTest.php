<?php declare(strict_types=1);

namespace CodeCollabTest\Unit\Form\Field;

use CodeCollab\Form\Field\Select;

class SelectTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers CodeCollab\Form\Field\Select::__construct
     */
    public function testImplementsCorrectInterface()
    {
        $field = new Select('selectfield');

        $this->assertInstanceOf('CodeCollab\Form\Field\Field', $field);
        $this->assertSame('selectfield', $field->getName());
        $this->assertSame('select', $field->getType());
    }
}
