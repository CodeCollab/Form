<?php declare(strict_types=1);

namespace CodeCollabTest\Unit\Form\Field;

use CodeCollab\Form\Field\Generic;
use CodeCollab\Form\Validation\Required;

class GenericTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers CodeCollab\Form\Field\Generic::__construct
     */
    public function testImplementsCorrectInterface()
    {
        $generic = $this->getMockForAbstractClass('CodeCollab\Form\Field\Generic', [], '', false);

        $this->assertInstanceOf('CodeCollab\Form\Field\Field', $generic);
    }

    /**
     * @covers CodeCollab\Form\Field\Generic::__construct
     * @covers CodeCollab\Form\Field\Generic::getName
     */
    public function testGetName()
    {
        $generic = $this->getMockForAbstractClass('CodeCollab\Form\Field\Generic', ['name', 'type', []]);

        $this->assertSame('name', $generic->getName());
    }

    /**
     * @covers CodeCollab\Form\Field\Generic::__construct
     * @covers CodeCollab\Form\Field\Generic::getType
     */
    public function testGetType()
    {
        $generic = $this->getMockForAbstractClass('CodeCollab\Form\Field\Generic', ['name', 'type', []]);

        $this->assertSame('type', $generic->getType());
    }

    /**
     * @covers CodeCollab\Form\Field\Generic::__construct
     * @covers CodeCollab\Form\Field\Generic::isRequired
     */
    public function testIsRequiredWhenRequiredRuleIsAdded()
    {
        $generic = $this->getMockForAbstractClass('CodeCollab\Form\Field\Generic', ['name', 'type', [new Required]]);

        $this->assertTrue($generic->isRequired());
    }

    /**
     * @covers CodeCollab\Form\Field\Generic::__construct
     * @covers CodeCollab\Form\Field\Generic::isRequired
     */
    public function testIsRequiredWhenRequiredRuleIsNotAdded()
    {
        $generic = $this->getMockForAbstractClass('CodeCollab\Form\Field\Generic', ['name', 'type', []]);

        $this->assertFalse($generic->isRequired());
    }

    /**
     * @covers CodeCollab\Form\Field\Generic::__construct
     * @covers CodeCollab\Form\Field\Generic::setValue
     */
    public function testSetValue()
    {
        $generic = $this->getMockForAbstractClass('CodeCollab\Form\Field\Generic', ['name', 'type', []]);

        $this->assertNull($generic->setValue('foobar'));
    }

    /**
     * @covers CodeCollab\Form\Field\Generic::__construct
     * @covers CodeCollab\Form\Field\Generic::getValue
     */
    public function testGetValueEmptyStringOnNullValue()
    {
        $generic = $this->getMockForAbstractClass('CodeCollab\Form\Field\Generic', ['name', 'type', []]);

        $this->assertSame('', $generic->getValue());
    }

    /**
     * @covers CodeCollab\Form\Field\Generic::__construct
     * @covers CodeCollab\Form\Field\Generic::setValue
     * @covers CodeCollab\Form\Field\Generic::getValue
     */
    public function testGetValueFilledIn()
    {
        $generic = $this->getMockForAbstractClass('CodeCollab\Form\Field\Generic', ['name', 'type', []]);

        $generic->setValue('foobar');

        $this->assertSame('foobar', $generic->getValue());
    }

    /**
     * @covers CodeCollab\Form\Field\Generic::__construct
     * @covers CodeCollab\Form\Field\Generic::validate
     */
    public function testValidateWithoutValidators()
    {
        $generic = $this->getMockForAbstractClass('CodeCollab\Form\Field\Generic', ['name', 'type', []]);

        $this->assertNull($generic->validate());
    }

    /**
     * @covers CodeCollab\Form\Field\Generic::__construct
     * @covers CodeCollab\Form\Field\Generic::validate
     */
    public function testValidateWithValidatorIsValid()
    {
        $validator = $this->getMock('CodeCollab\Form\Validation\Validator');

        $validator
            ->expects($this->once())
            ->method('validate')
            ->with($this->equalTo(''))
        ;

        $validator
            ->expects($this->once())
            ->method('isValid')
            ->willReturn(true)
        ;

        $validator
            ->expects($this->never())
            ->method('getError')
        ;

        $generic = $this->getMockForAbstractClass('CodeCollab\Form\Field\Generic', ['name', 'type', [$validator]]);

        $this->assertNull($generic->validate());
    }

    /**
     * @covers CodeCollab\Form\Field\Generic::__construct
     * @covers CodeCollab\Form\Field\Generic::validate
     */
    public function testValidateWithValidatorIsNotValid()
    {
        $validator = $this->getMock('CodeCollab\Form\Validation\Validator');

        $validator
            ->expects($this->once())
            ->method('validate')
            ->with($this->equalTo(''))
        ;

        $validator
            ->expects($this->once())
            ->method('isValid')
            ->willReturn(false)
        ;

        $validator
            ->expects($this->once())
            ->method('getError')
            ->willReturn(['the.error' => []])
        ;

        $generic = $this->getMockForAbstractClass('CodeCollab\Form\Field\Generic', ['name', 'type', [$validator]]);

        $this->assertNull($generic->validate());
    }

    /**
     * @covers CodeCollab\Form\Field\Generic::__construct
     * @covers CodeCollab\Form\Field\Generic::setValue
     * @covers CodeCollab\Form\Field\Generic::getValue
     * @covers CodeCollab\Form\Field\Generic::validate
     */
    public function testValidateWithValidatorIsValidWithValue()
    {
        $validator = $this->getMock('CodeCollab\Form\Validation\Validator');

        $validator
            ->expects($this->once())
            ->method('validate')
            ->with($this->equalTo('foobar'))
        ;

        $validator
            ->expects($this->once())
            ->method('isValid')
            ->willReturn(true)
        ;

        $validator
            ->expects($this->never())
            ->method('getError')
        ;

        $generic = $this->getMockForAbstractClass('CodeCollab\Form\Field\Generic', ['name', 'type', [$validator]]);

        $generic->setValue('foobar');

        $this->assertNull($generic->validate());
    }

    /**
     * @covers CodeCollab\Form\Field\Generic::__construct
     * @covers CodeCollab\Form\Field\Generic::validate
     * @covers CodeCollab\Form\Field\Generic::isValid
     */
    public function testIsValidNotValid()
    {
        $validator = $this->getMock('CodeCollab\Form\Validation\Validator');

        $validator
            ->expects($this->once())
            ->method('validate')
            ->with($this->equalTo(''))
        ;

        $validator
            ->expects($this->once())
            ->method('isValid')
            ->willReturn(false)
        ;

        $validator
            ->expects($this->once())
            ->method('getError')
            ->willReturn(['the.error' => []])
        ;

        $generic = $this->getMockForAbstractClass('CodeCollab\Form\Field\Generic', ['name', 'type', [$validator]]);

        $generic->validate();

        $this->assertFalse($generic->isValid());
    }

    /**
     * @covers CodeCollab\Form\Field\Generic::__construct
     * @covers CodeCollab\Form\Field\Generic::isValid
     */
    public function testIsValidValid()
    {
        $validator = $this->getMock('CodeCollab\Form\Validation\Validator');

        $generic = $this->getMockForAbstractClass('CodeCollab\Form\Field\Generic', ['name', 'type', [$validator]]);

        $this->assertTrue($generic->isValid());
    }

    /**
     * @covers CodeCollab\Form\Field\Generic::__construct
     * @covers CodeCollab\Form\Field\Generic::validate
     * @covers CodeCollab\Form\Field\Generic::getErrorType
     */
    public function testGetErrorTypeReturnsCorrectType()
    {
        $validator = $this->getMock('CodeCollab\Form\Validation\Validator');

        $validator
            ->expects($this->once())
            ->method('validate')
            ->with($this->equalTo(''))
        ;

        $validator
            ->expects($this->once())
            ->method('isValid')
            ->willReturn(false)
        ;

        $validator
            ->expects($this->once())
            ->method('getError')
            ->willReturn(['the.error' => []])
        ;

        $generic = $this->getMockForAbstractClass('CodeCollab\Form\Field\Generic', ['name', 'type', [$validator]]);

        $generic->validate();

        $this->assertSame('the.error', $generic->getErrorType());
    }

    /**
     * @covers CodeCollab\Form\Field\Generic::__construct
     * @covers CodeCollab\Form\Field\Generic::getErrorType
     */
    public function testGetErrorTypeWhenValid()
    {
        $validator = $this->getMock('CodeCollab\Form\Validation\Validator');

        $generic = $this->getMockForAbstractClass('CodeCollab\Form\Field\Generic', ['name', 'type', [$validator]]);

        $this->assertSame('', $generic->getErrorType());
    }

    /**
     * @covers CodeCollab\Form\Field\Generic::__construct
     * @covers CodeCollab\Form\Field\Generic::validate
     * @covers CodeCollab\Form\Field\Generic::getErrorData
     */
    public function testGetErrorDataReturnsErrorsWhenNotValid()
    {
        $validator = $this->getMock('CodeCollab\Form\Validation\Validator');

        $validator
            ->expects($this->once())
            ->method('validate')
            ->with($this->equalTo(''))
        ;

        $validator
            ->expects($this->once())
            ->method('isValid')
            ->willReturn(false)
        ;

        $validator
            ->expects($this->once())
            ->method('getError')
            ->willReturn(['the.error' => []])
        ;

        $generic = $this->getMockForAbstractClass('CodeCollab\Form\Field\Generic', ['name', 'type', [$validator]]);

        $generic->validate();

        $this->assertSame(['the.error' => []], $generic->getErrorData());
    }

    /**
     * @covers CodeCollab\Form\Field\Generic::__construct
     * @covers CodeCollab\Form\Field\Generic::getErrorData
     */
    public function testGetErrorDataWhenValid()
    {
        $validator = $this->getMock('CodeCollab\Form\Validation\Validator');

        $generic = $this->getMockForAbstractClass('CodeCollab\Form\Field\Generic', ['name', 'type', [$validator]]);

        $this->assertSame([], $generic->getErrorData());
    }
}
