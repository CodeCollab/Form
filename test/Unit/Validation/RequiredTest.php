<?php declare(strict_types=1);

namespace CodeCollabTest\Unit\Form\Validation;

use CodeCollab\Form\Validation\Required;

class RequiredTest extends \PHPUnit_Framework_TestCase
{
    /**
     */
    public function testImplementsCorrectInterface()
    {
        $validator = new Required();

        $this->assertInstanceOf('CodeCollab\Form\Validation\Validator', $validator);
    }

    /**
     * @covers CodeCollab\Form\Validation\Required::validate
     */
    public function testValidateIsInvalidWithoutValue()
    {
        $validator = new Required();

        $this->assertNull($validator->validate(''));
        $this->assertFalse($validator->isValid());
        $this->assertSame(['required' => []], $validator->getError());
    }

    /**
     * @covers CodeCollab\Form\Validation\Required::validate
     */
    public function testValidateIsValidWithValue()
    {
        $validator = new Required();

        $this->assertNull($validator->validate('foo'));
        $this->assertTrue($validator->isValid());
    }
}
