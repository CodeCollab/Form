<?php declare(strict_types=1);

namespace CodeCollabTest\Unit\Form\Validation;

use CodeCollab\Form\Validation\Email;

class EmailTest extends \PHPUnit_Framework_TestCase
{
    /**
     */
    public function testImplementsCorrectInterface()
    {
        $validator = new Email();

        $this->assertInstanceOf('CodeCollab\Form\Validation\Validator', $validator);
    }

    /**
     * @covers CodeCollab\Form\Validation\Email::validate
     */
    public function testValidateIsValidWithoutValue()
    {
        $validator = new Email();

        $this->assertNull($validator->validate(''));
        $this->assertTrue($validator->isValid());
    }

    /**
     * @covers CodeCollab\Form\Validation\Email::validate
     */
    public function testValidateIsValidWithValidEmailAddress()
    {
        $validator = new Email();

        $this->assertNull($validator->validate('info@example.com'));
        $this->assertTrue($validator->isValid());
    }

    /**
     * @covers CodeCollab\Form\Validation\Email::validate
     */
    public function testValidateIsInvalidWithInvalidEmailAddress()
    {
        $validator = new Email();

        $this->assertNull($validator->validate('info'));
        $this->assertFalse($validator->isValid());
        $this->assertSame(['type.email' => []], $validator->getError());
    }
}
