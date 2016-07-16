<?php declare(strict_types=1);

namespace CodeCollab\Form\Field;

use CodeCollab\Form\Field\Email;
use CodeCollab\Form\Field\Field;

class EmailTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers CodeCollab\Form\Field\Email::__construct
     */
    public function testImplementsCorrectInterface()
    {
        $field = new Email('emailfield');

        $this->assertInstanceOf(Field::class, $field);
        $this->assertSame('emailfield', $field->getName());
        $this->assertSame('email', $field->getType());
    }
}
