<?php declare(strict_types=1);

namespace CodeCollabTest\Unit\Form\Field;

use CodeCollab\Form\Field\Radio;
use CodeCollab\Form\Field\Field;

class RadioTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers CodeCollab\Form\Field\Radio::__construct
     */
    public function testImplementsCorrectInterface()
    {
        $field = new Radio('radiofield');

        $this->assertInstanceOf(Field::class, $field);
        $this->assertSame('radiofield', $field->getName());
        $this->assertSame('radio', $field->getType());
    }
}
