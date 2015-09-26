<?php declare(strict_types=1);

namespace CodeCollabTest\Integration\Form;

use CodeCollab\Form\Field\Text;
use CodeCollab\Form\Validation\Required;
use CodeCollab\Form\Validation\MinLength;

class ValidationTest extends \PHPUnit_Framework_TestCase
{
    public function testGetErrorTypeReturnsCorrectTypeOnSingleError()
    {
        $textField = new Text('test', [new Required()]);

        $this->assertNull($textField->validate());

        $this->assertFalse($textField->isValid());

        $this->assertSame('required', $textField->getErrorType());
    }

    public function testGetErrorTypeReturnsCorrectTypeOnMultipleErrors()
    {
        $textField = new Text('test', [new Required(), new Minlength(6)]);

        $this->assertNull($textField->validate());

        $this->assertFalse($textField->isValid());

        $this->assertSame('required', $textField->getErrorType());
    }

    public function testGetErrorTypeReturnsCorrectTypeWhenValidatingMultipleTimes()
    {
        $textField = new Text('test', [new Required()]);

        $this->assertNull($textField->validate());
        $this->assertNull($textField->validate());

        $this->assertFalse($textField->isValid());

        $this->assertSame('required', $textField->getErrorType());
    }

    public function testGetErrorDataOnErrorWithoutExtraInformation()
    {
        $textField = new Text('test', [new Required()]);

        $this->assertNull($textField->validate());

        $this->assertFalse($textField->isValid());

        $this->assertSame([], $textField->getErrorData());
    }

    public function testGetErrorDataOnErrorWithExtraInformation()
    {
        $textField = new Text('test', [new Minlength(6)]);

        $this->assertNull($textField->setValue('foo'));

        $this->assertNull($textField->validate());

        $this->assertFalse($textField->isValid());

        $this->assertSame([6], $textField->getErrorData());
    }
}
