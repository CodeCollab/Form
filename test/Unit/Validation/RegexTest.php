<?php declare(strict_types=1);

namespace CodeCollabTest\Unit\Form\Validation;

use CodeCollab\Form\Validation\Regex;
use CodeCollab\Form\Validation\Validator;

class RegexTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers CodeCollab\Form\Validation\Regex::__construct
     */
    public function testImplementsCorrectInterface()
    {
        $validator = new Regex('/foo/');

        $this->assertInstanceOf(Validator::class, $validator);
    }

    /**
     * @covers CodeCollab\Form\Validation\Regex::__construct
     * @covers CodeCollab\Form\Validation\Regex::validate
     */
    public function testValidateIsValidWithoutValue()
    {
        $validator = new Regex('/foo/');

        $this->assertNull($validator->validate(''));
        $this->assertTrue($validator->isValid());
    }

    /**
     * @covers CodeCollab\Form\Validation\Regex::__construct
     * @covers CodeCollab\Form\Validation\Regex::validate
     */
    public function testValidateIsValidMatches()
    {
        $validator = new Regex('/foo/');

        $this->assertNull($validator->validate('foo'));
        $this->assertTrue($validator->isValid());
    }

    /**
     * @covers CodeCollab\Form\Validation\Regex::__construct
     * @covers CodeCollab\Form\Validation\Regex::validate
     */
    public function testValidateIsInvalidDoesntMatch()
    {
        $validator = new Regex('/foo/');

        $this->assertNull($validator->validate('bar'));
        $this->assertFalse($validator->isValid());
        $this->assertSame(['regex' => []], $validator->getError());
    }
}
