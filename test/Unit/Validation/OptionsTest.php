<?php declare(strict_types=1);

namespace CodeCollabTest\Unit\Form\Validation;

use CodeCollab\Form\Validation\Options;

class OptionsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers CodeCollab\Form\Validation\Options::__construct
     */
    public function testImplementsCorrectInterface()
    {
        $validator = new Options([]);

        $this->assertInstanceOf('CodeCollab\Form\Validation\Validator', $validator);
    }

    /**
     * @covers CodeCollab\Form\Validation\Options::__construct
     * @covers CodeCollab\Form\Validation\Options::validate
     */
    public function testValidateIsValidWithoutValue()
    {
        $validator = new Options([]);

        $this->assertNull($validator->validate(''));
        $this->assertTrue($validator->isValid());
    }

    /**
     * @covers CodeCollab\Form\Validation\Options::__construct
     * @covers CodeCollab\Form\Validation\Options::validate
     */
    public function testValidateIsValidMatchesValue()
    {
        $validator = new Options(['thevalue']);

        $this->assertNull($validator->validate('thevalue'));
        $this->assertTrue($validator->isValid());
    }

    /**
     * @covers CodeCollab\Form\Validation\Options::__construct
     * @covers CodeCollab\Form\Validation\Options::validate
     */
    public function testValidateIsInvalid()
    {
        $validator = new Options([]);

        $this->assertNull($validator->validate('foo'));
        $this->assertFalse($validator->isValid());
        $this->assertSame(['options' => [[]]], $validator->getError());
    }
}
