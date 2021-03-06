<?php declare(strict_types=1);

namespace CodeCollabTest\Unit\Form\Field;

use CodeCollab\Form\Field\Password;
use CodeCollab\Form\Field\Field;

class PasswordTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers CodeCollab\Form\Field\Password::__construct
     */
    public function testImplementsCorrectInterface()
    {
        $field = new Password('passwordfield');

        $this->assertInstanceOf(Field::class, $field);
        $this->assertSame('passwordfield', $field->getName());
        $this->assertSame('password', $field->getType());
    }
}
