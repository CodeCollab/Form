<?php declare(strict_types=1);

namespace CodeCollabTest\Unit\Form\Validation;

use CodeCollab\Form\Validation\Min;

class MinTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers CodeCollab\Form\Validation\Min::__construct
     */
    public function testImplementsCorrectInterface()
    {
        $validator = new Min(1);

        $this->assertInstanceOf('CodeCollab\Form\Validation\Validator', $validator);
    }

    /**
     * @covers CodeCollab\Form\Validation\Min::__construct
     * @covers CodeCollab\Form\Validation\Min::validate
     */
    public function testValidateIsValidWithoutValue()
    {
        $validator = new Min(1);

        $this->assertNull($validator->validate(''));
        $this->assertTrue($validator->isValid());
    }

    /**
     * @covers CodeCollab\Form\Validation\Min::__construct
     * @covers CodeCollab\Form\Validation\Min::validate
     */
    public function testValidateIsValidLargerThanMin()
    {
        $validator = new Min(2);

        $this->assertNull($validator->validate('3'));
        $this->assertTrue($validator->isValid());
    }

    /**
     * @covers CodeCollab\Form\Validation\Min::__construct
     * @covers CodeCollab\Form\Validation\Min::validate
     */
    public function testValidateIsValidEqualsMin()
    {
        $validator = new Min(2);

        $this->assertNull($validator->validate('2'));
        $this->assertTrue($validator->isValid());
    }

    /**
     * @covers CodeCollab\Form\Validation\Min::__construct
     * @covers CodeCollab\Form\Validation\Min::validate
     */
    public function testValidateIsInvalidSmallerThanMin()
    {
        $validator = new Min(2);

        $this->assertNull($validator->validate('1'));
        $this->assertFalse($validator->isValid());
        $this->assertSame(['min.%' => [2.0]], $validator->getError());
    }
}
