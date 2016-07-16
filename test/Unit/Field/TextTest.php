<?php declare(strict_types=1);

namespace CodeCollabTest\Unit\Form\Field;

use CodeCollab\Form\Field\Text;
use CodeCollab\Form\Field\Field;

class TextTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers CodeCollab\Form\Field\Text::__construct
     */
    public function testImplementsCorrectInterface()
    {
        $field = new Text('textfield');

        $this->assertInstanceOf(Field::class, $field);
        $this->assertSame('textfield', $field->getName());
        $this->assertSame('text', $field->getType());
    }
}
