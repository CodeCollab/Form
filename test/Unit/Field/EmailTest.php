<?php declare(strict_types=1);

namespace CodeCollab\Form\Field;

use CodeCollab\Form\Field\Email;

class EmailTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers CodeCollab\Form\Field\Email::__construct
     */
    public function testImplementsCorrectInterface()
    {
        $field = new Email('emailfield');

        $this->assertInstanceOf('CodeCollab\Form\Field\Field', $field);
        $this->assertSame('emailfield', $field->getName());
        $this->assertSame('email', $field->getType());
    }
}
