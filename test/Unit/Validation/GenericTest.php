<?php declare(strict_types=1);

namespace CodeCollabTest\Unit\Form\Validation;

use CodeCollab\Form\Validation\Generic;
use CodeCollab\Form\Validation\Validator;

class GenericTest extends \PHPUnit_Framework_TestCase
{
    /**
     */
    public function testImplementsCorrectInterface()
    {
        $validator = $this->getMockForAbstractClass(Generic::class);

        $this->assertInstanceOf(Validator::class, $validator);
    }

    /**
     * @covers CodeCollab\Form\Validation\Generic::isValid
     */
    public function testIsValidNotValid()
    {
        $validator = (new class Extends Generic {
            public function validate(string $value) {
                $this->error = ['error' => []];
            }
        });

        $validator->validate('thevalue');

        $this->assertFalse($validator->isValid());
    }

    /**
     * @covers CodeCollab\Form\Validation\Generic::isValid
     */
    public function testIsValidValid()
    {
        $validator = $this->getMockForAbstractClass(Generic::class);

        $this->assertTrue($validator->isValid());
    }

    /**
     * @covers CodeCollab\Form\Validation\Generic::getError
     */
    public function testGetErrorNotValid()
    {
        $validator = (new class Extends Generic {
            public function validate(string $value) {
                $this->error = ['error' => []];
            }
        });

        $validator->validate('thevalue');

        $this->assertSame(['error' => []], $validator->getError());
    }

    /**
     * @covers CodeCollab\Form\Validation\Generic::getError
     */
    public function testGetErrorValid()
    {
        $validator = $this->getMockForAbstractClass(Generic::class);

        $this->assertSame([], $validator->getError());
    }
}
