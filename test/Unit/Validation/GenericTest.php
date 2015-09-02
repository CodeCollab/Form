<?php declare(strict_types=1);

namespace CodeCollabTest\Unit\Form\Validation;

use CodeCollab\Form\Validation\Generic;

class GenericTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers CodeCollab\Form\Validation\Generic::__construct
     */
    public function testImplementsCorrectInterface()
    {
        $validator = $this->getMockForAbstractClass('CodeCollab\Form\Validation\Generic');

        $this->assertInstanceOf('CodeCollab\Form\Validation\Validator', $validator);
    }

    /**
     * @covers CodeCollab\Form\Validation\Generic::__construct
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
     * @covers CodeCollab\Form\Validation\Generic::__construct
     * @covers CodeCollab\Form\Validation\Generic::isValid
     */
    public function testIsValidValid()
    {
        $validator = $this->getMockForAbstractClass('CodeCollab\Form\Validation\Generic');

        $this->assertTrue($validator->isValid());
    }

    /**
     * @covers CodeCollab\Form\Validation\Generic::__construct
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
     * @covers CodeCollab\Form\Validation\Generic::__construct
     * @covers CodeCollab\Form\Validation\Generic::getError
     */
    public function testGetErrorValid()
    {
        $validator = $this->getMockForAbstractClass('CodeCollab\Form\Validation\Generic');

        $this->assertSame([], $validator->getError());
    }
}
