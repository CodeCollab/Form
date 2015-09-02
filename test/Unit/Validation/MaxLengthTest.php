<?php declare(strict_types=1);

namespace CodeCollabTest\Unit\Form\Validation;

use CodeCollab\Form\Validation\MaxLength;

class MaxLengthTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers CodeCollab\Form\Validation\MaxLength::__construct
     */
    public function testImplementsCorrectInterface()
    {
        $validator = new MaxLength(1);

        $this->assertInstanceOf('CodeCollab\Form\Validation\Validator', $validator);
    }

    /**
     * @covers CodeCollab\Form\Validation\MaxLength::__construct
     * @covers CodeCollab\Form\Validation\MaxLength::validate
     */
    public function testValidateIsValidWithoutValue()
    {
        $validator = new MaxLength(1);

        $this->assertNull($validator->validate(''));
        $this->assertTrue($validator->isValid());
    }

    /**
     * @covers CodeCollab\Form\Validation\MaxLength::__construct
     * @covers CodeCollab\Form\Validation\MaxLength::validate
     */
    public function testValidateIsValidShorterThanMax()
    {
        $validator = new MaxLength(2);

        $this->assertNull($validator->validate('f'));
        $this->assertTrue($validator->isValid());
    }

    /**
     * @covers CodeCollab\Form\Validation\MaxLength::__construct
     * @covers CodeCollab\Form\Validation\MaxLength::validate
     */
    public function testValidateIsValidSameLengthAsMax()
    {
        $validator = new MaxLength(2);

        $this->assertNull($validator->validate('fo'));
        $this->assertTrue($validator->isValid());
    }

    /**
     * @covers CodeCollab\Form\Validation\MaxLength::__construct
     * @covers CodeCollab\Form\Validation\MaxLength::validate
     */
    public function testValidateIsInvalidLongerThanMax()
    {
        $validator = new MaxLength(1);

        $this->assertNull($validator->validate('foo'));
        $this->assertFalse($validator->isValid());
    }
}
