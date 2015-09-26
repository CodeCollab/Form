<?php declare(strict_types=1);

namespace CodeCollabTest\Unit\Form\Validation;

use CodeCollab\Form\Validation\MinLength;

class MinLengthTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers CodeCollab\Form\Validation\MinLength::__construct
     */
    public function testImplementsCorrectInterface()
    {
        $validator = new MinLength(1);

        $this->assertInstanceOf('CodeCollab\Form\Validation\Validator', $validator);
    }

    /**
     * @covers CodeCollab\Form\Validation\MinLength::__construct
     * @covers CodeCollab\Form\Validation\MinLength::validate
     */
    public function testValidateIsValidWithoutValue()
    {
        $validator = new MinLength(1);

        $this->assertNull($validator->validate(''));
        $this->assertTrue($validator->isValid());
    }

    /**
     * @covers CodeCollab\Form\Validation\MinLength::__construct
     * @covers CodeCollab\Form\Validation\MinLength::validate
     */
    public function testValidateIsValidLargerThanMin()
    {
        $validator = new MinLength(2);

        $this->assertNull($validator->validate('foo'));
        $this->assertTrue($validator->isValid());
    }

    /**
     * @covers CodeCollab\Form\Validation\MinLength::__construct
     * @covers CodeCollab\Form\Validation\MinLength::validate
     */
    public function testValidateIsValidSameLengthAsMin()
    {
        $validator = new MinLength(2);

        $this->assertNull($validator->validate('fo'));
        $this->assertTrue($validator->isValid());
    }

    /**
     * @covers CodeCollab\Form\Validation\MinLength::__construct
     * @covers CodeCollab\Form\Validation\MinLength::validate
     */
    public function testValidateIsInvalidShorterThanMin()
    {
        $validator = new MinLength(3);

        $this->assertNull($validator->validate('fo'));
        $this->assertFalse($validator->isValid());
        $this->assertSame(['minlength.%' => [3]], $validator->getError());
    }
}
