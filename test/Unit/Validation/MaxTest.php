<?php declare(strict_types=1);

namespace CodeCollabTest\Unit\Form\Validation;

use CodeCollab\Form\Validation\Max;

class MaxTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers CodeCollab\Form\Validation\Max::__construct
     */
    public function testImplementsCorrectInterface()
    {
        $validator = new Max(1);

        $this->assertInstanceOf('CodeCollab\Form\Validation\Validator', $validator);
    }

    /**
     * @covers CodeCollab\Form\Validation\Max::__construct
     * @covers CodeCollab\Form\Validation\Max::validate
     */
    public function testValidateIsValidWithoutValue()
    {
        $validator = new Max(1);

        $this->assertNull($validator->validate(''));
        $this->assertTrue($validator->isValid());
    }

    /**
     * @covers CodeCollab\Form\Validation\Max::__construct
     * @covers CodeCollab\Form\Validation\Max::validate
     */
    public function testValidateIsValidSmallerThanMax()
    {
        $validator = new Max(2);

        $this->assertNull($validator->validate('1'));
        $this->assertTrue($validator->isValid());
    }

    /**
     * @covers CodeCollab\Form\Validation\Max::__construct
     * @covers CodeCollab\Form\Validation\Max::validate
     */
    public function testValidateIsValidEqualsMax()
    {
        $validator = new Max(2);

        $this->assertNull($validator->validate('2'));
        $this->assertTrue($validator->isValid());
    }

    /**
     * @covers CodeCollab\Form\Validation\Max::__construct
     * @covers CodeCollab\Form\Validation\Max::validate
     */
    public function testValidateIsInvalidLargerThanMax()
    {
        $validator = new Max(1);

        $this->assertNull($validator->validate('2'));
        $this->assertFalse($validator->isValid());
        $this->assertSame(['max.%' => [1.0]], $validator->getError());
    }
}
