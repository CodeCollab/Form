<?php declare(strict_types=1);

namespace CodeCollabTest\Unit\Form\Validation;

use CodeCollab\Form\Validation\Match;
use CodeCollab\Form\Validation\Validator;

class MatchTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers CodeCollab\Form\Validation\Match::__construct
     */
    public function testImplementsCorrectInterface()
    {
        $validator = new Match('thevalue');

        $this->assertInstanceOf(Validator::class, $validator);
    }

    /**
     * @covers CodeCollab\Form\Validation\Match::__construct
     * @covers CodeCollab\Form\Validation\Match::validate
     */
    public function testValidateIsValidWithoutValue()
    {
        $validator = new Match('thevalue');

        $this->assertNull($validator->validate(''));
        $this->assertTrue($validator->isValid());
    }

    /**
     * @covers CodeCollab\Form\Validation\Match::__construct
     * @covers CodeCollab\Form\Validation\Match::validate
     */
    public function testValidateIsValidMatchesValue()
    {
        $validator = new Match('thevalue');

        $this->assertNull($validator->validate('thevalue'));
        $this->assertTrue($validator->isValid());
    }

    /**
     * @covers CodeCollab\Form\Validation\Match::__construct
     * @covers CodeCollab\Form\Validation\Match::validate
     */
    public function testValidateIsInvalidLongerThanMax()
    {
        $validator = new Match('thevalue');

        $this->assertNull($validator->validate('foo'));
        $this->assertFalse($validator->isValid());
        $this->assertSame(['match' => ['thevalue']], $validator->getError());
    }
}
