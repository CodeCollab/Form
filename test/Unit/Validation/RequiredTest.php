<?php declare(strict_types=1);

namespace CodeCollabTest\Unit\Form\Validation;

use CodeCollab\Form\Validation\Required;
use CodeCollab\Form\Validation\Validator;

class RequiredTest extends \PHPUnit_Framework_TestCase
{
    /**
     */
    public function testImplementsCorrectInterface()
    {
        $validator = new Required();

        $this->assertInstanceOf(Validator::class, $validator);
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
