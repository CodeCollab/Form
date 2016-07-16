<?php declare(strict_types=1);

namespace CodeCollabTest\Unit\Form\Field;

use CodeCollab\Form\Field\Generic;
use CodeCollab\Form\Validation\Required;
use CodeCollab\Form\Validation\Validator;

class GenericTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers CodeCollab\Form\Field\Generic::__construct
     */
    public function testImplementsCorrectInterface()
    {
        $generic = $this->getMockForAbstractClass(Generic::class, [], '', false);

        $this->assertInstanceOf('CodeCollab\Form\Field\Field', $generic);
    }

    /**
     * @covers CodeCollab\Form\Field\Generic::__construct
     * @covers CodeCollab\Form\Field\Generic::getName
     */
    public function testGetName()
    {
        $generic = $this->getMockForAbstractClass(Generic::class, ['name', 'type', []]);

        $this->assertSame('name', $generic->getName());
    }

    /**
     * @covers CodeCollab\Form\Field\Generic::__construct
     * @covers CodeCollab\Form\Field\Generic::getType
     */
    public function testGetType()
    {
        $generic = $this->getMockForAbstractClass(Generic::class, ['name', 'type', []]);

        $this->assertSame('type', $generic->getType());
    }

    /**
     * @covers CodeCollab\Form\Field\Generic::__construct
     * @covers CodeCollab\Form\Field\Generic::getDefaultValue
     */
    public function testGetDefaultValueWhenNotSet()
    {
        $generic = $this->getMockForAbstractClass(Generic::class, ['name', 'type', []]);

        $this->assertSame('', $generic->getDefaultValue());
    }

    /**
     * @covers CodeCollab\Form\Field\Generic::__construct
     * @covers CodeCollab\Form\Field\Generic::getDefaultValue
     */
    public function testGetDefaultValueSet()
    {
        $generic = $this->getMockForAbstractClass(Generic::class, ['name', 'type', [], 'defaultvalue']);

        $this->assertSame('defaultvalue', $generic->getDefaultValue());
    }

    /**
     * @covers CodeCollab\Form\Field\Generic::__construct
     * @covers CodeCollab\Form\Field\Generic::isRequired
     */
    public function testIsRequiredWhenRequiredRuleIsAdded()
    {
        $generic = $this->getMockForAbstractClass(Generic::class, ['name', 'type', [new Required]]);

        $this->assertTrue($generic->isRequired());
    }

    /**
     * @covers CodeCollab\Form\Field\Generic::__construct
     * @covers CodeCollab\Form\Field\Generic::isRequired
     */
    public function testIsRequiredWhenRequiredRuleIsNotAdded()
    {
        $generic = $this->getMockForAbstractClass(Generic::class, ['name', 'type', []]);

        $this->assertFalse($generic->isRequired());
    }

    /**
     * @covers CodeCollab\Form\Field\Generic::__construct
     * @covers CodeCollab\Form\Field\Generic::setValue
     */
    public function testSetValue()
    {
        $generic = $this->getMockForAbstractClass(Generic::class, ['name', 'type', []]);

        $this->assertNull($generic->setValue('foobar'));
    }

    /**
     * @covers CodeCollab\Form\Field\Generic::__construct
     * @covers CodeCollab\Form\Field\Generic::getValue
     */
    public function testGetValueDefaultWhenNotYetValidated()
    {
        $generic = $this->getMockForAbstractClass(Generic::class, ['name', 'type', [], 'default']);

        $this->assertSame('default', $generic->getValue());
    }

    /**
     * @covers CodeCollab\Form\Field\Generic::__construct
     * @covers CodeCollab\Form\Field\Generic::getValue
     * @covers CodeCollab\Form\Field\Generic::validate
     */
    public function testGetValueDoesntReturnDefaultWhenValidated()
    {
        $generic = $this->getMockForAbstractClass(Generic::class, ['name', 'type', [], 'default']);

        $generic->validate();

        $this->assertSame('', $generic->getValue());
    }

    /**
     * @covers CodeCollab\Form\Field\Generic::__construct
     * @covers CodeCollab\Form\Field\Generic::getValue
     */
    public function testGetValueEmptyStringOnNullValue()
    {
        $generic = $this->getMockForAbstractClass(Generic::class, ['name', 'type', []]);

        $this->assertSame('', $generic->getValue());
    }

    /**
     * @covers CodeCollab\Form\Field\Generic::__construct
     * @covers CodeCollab\Form\Field\Generic::setValue
     * @covers CodeCollab\Form\Field\Generic::getValue
     */
    public function testGetValueFilledIn()
    {
        $generic = $this->getMockForAbstractClass(Generic::class, ['name', 'type', []]);

        $generic->setValue('foobar');

        $this->assertSame('foobar', $generic->getValue());
    }

    /**
     * @covers CodeCollab\Form\Field\Generic::__construct
     * @covers CodeCollab\Form\Field\Generic::getValue
     */
    public function testGetValueDefault()
    {
        $generic = $this->getMockForAbstractClass(Generic::class, ['name', 'type', [], 'thisisdefault']);

        $this->assertSame('thisisdefault', $generic->getValue());
    }

    /**
     * @covers CodeCollab\Form\Field\Generic::__construct
     * @covers CodeCollab\Form\Field\Generic::validate
     */
    public function testValidateWithoutValidators()
    {
        $generic = $this->getMockForAbstractClass(Generic::class, ['name', 'type', []]);

        $this->assertNull($generic->validate());
    }

    /**
     * @covers CodeCollab\Form\Field\Generic::__construct
     * @covers CodeCollab\Form\Field\Generic::validate
     */
    public function testValidateWithValidatorIsValid()
    {
        $validator = $this->createMock(Validator::class);

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

        $generic = $this->getMockForAbstractClass(Generic::class, ['name', 'type', [$validator]]);

        $this->assertNull($generic->validate());
    }

    /**
     * @covers CodeCollab\Form\Field\Generic::__construct
     * @covers CodeCollab\Form\Field\Generic::validate
     */
    public function testValidateWithValidatorIsNotValid()
    {
        $validator = $this->createMock(Validator::class);

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

        $generic = $this->getMockForAbstractClass(Generic::class, ['name', 'type', [$validator]]);

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
        $validator = $this->createMock(Validator::class);

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

        $generic = $this->getMockForAbstractClass(Generic::class, ['name', 'type', [$validator]]);

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
        $validator = $this->createMock(Validator::class);

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

        $generic = $this->getMockForAbstractClass(Generic::class, ['name', 'type', [$validator]]);

        $generic->validate();

        $this->assertFalse($generic->isValid());
    }

    /**
     * @covers CodeCollab\Form\Field\Generic::__construct
     * @covers CodeCollab\Form\Field\Generic::validate
     * @covers CodeCollab\Form\Field\Generic::isValid
     */
    public function testIsValidNotValidCustomValidation()
    {
        $validator = $this->createMock(Validator::class);

        $generic = $this->getMockForAbstractClass(Generic::class, ['name', 'type', [$validator]]);

        $generic->invalidate('custom', ['foo' => 'bar']);

        $generic->validate();

        $this->assertFalse($generic->isValid());
        $this->assertSame('custom', $generic->getErrorType());
        $this->assertSame(['foo' => 'bar'], $generic->getErrorData());
    }

    /**
     * @covers CodeCollab\Form\Field\Generic::__construct
     * @covers CodeCollab\Form\Field\Generic::isValid
     */
    public function testIsValidValid()
    {
        $validator = $this->createMock(Validator::class);

        $generic = $this->getMockForAbstractClass(Generic::class, ['name', 'type', [$validator]]);

        $this->assertTrue($generic->isValid());
    }

    /**
     * @covers CodeCollab\Form\Field\Generic::__construct
     * @covers CodeCollab\Form\Field\Generic::validate
     * @covers CodeCollab\Form\Field\Generic::getErrorType
     */
    public function testGetErrorTypeReturnsCorrectType()
    {
        $validator = $this->getMock(Validator::class);

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

        $generic = $this->getMockForAbstractClass(Generic::class, ['name', 'type', [$validator]]);

        $generic->validate();

        $this->assertSame('the.error', $generic->getErrorType());
    }

    /**
     * @covers CodeCollab\Form\Field\Generic::__construct
     * @covers CodeCollab\Form\Field\Generic::getErrorType
     */
    public function testGetErrorTypeWhenValid()
    {
        $validator = $this->createMock(Validator::class);

        $generic = $this->getMockForAbstractClass(Generic::class, ['name', 'type', [$validator]]);

        $this->assertSame('', $generic->getErrorType());
    }

    /**
     * @covers CodeCollab\Form\Field\Generic::__construct
     * @covers CodeCollab\Form\Field\Generic::validate
     * @covers CodeCollab\Form\Field\Generic::getErrorData
     */
    public function testGetErrorDataReturnsErrorsWhenNotValid()
    {
        $validator = $this->createMock(Validator::class);

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

        $generic = $this->getMockForAbstractClass(Generic::class, ['name', 'type', [$validator]]);

        $generic->validate();

        $this->assertSame([], $generic->getErrorData());
    }

    /**
     * @covers CodeCollab\Form\Field\Generic::__construct
     * @covers CodeCollab\Form\Field\Generic::getErrorData
     */
    public function testGetErrorDataWhenValid()
    {
        $validator = $this->createMock(Validator::class);

        $generic = $this->getMockForAbstractClass(Generic::class, ['name', 'type', [$validator]]);

        $this->assertSame([], $generic->getErrorData());
    }
}
