<?php declare(strict_types=1);

namespace CodeCollabTest\Unit\Form;

use CodeCollab\Form\BaseForm;
use CodeCollab\Form\Form;
use CodeCollab\CsrfToken\Token;
use CodeCollab\Form\Field\Field;
use CodeCollab\Http\Request\Request;
use CodeCollab\Form\OutOfScopeException;

class BaseFormTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers CodeCollab\Form\BaseForm::__construct
     */
    public function testImplementsCorrectInterfaces()
    {
        $form = $this->getMockForAbstractClass(BaseForm::class, [], '', false);

        $this->assertInstanceOf(Form::class, $form);
        $this->assertInstanceOf(\ArrayAccess::class, $form);
    }

    /**
     * @covers CodeCollab\Form\BaseForm::__construct
     * @covers CodeCollab\Form\BaseForm::addField
     */
    public function testAddField()
    {
        $token = $this->createMock(Token::class);
        $field = $this->createMock(Field::class);

        $form = (new class($token, $field) extends BaseForm {
            private $field;

            public function __construct($token, $field) {
                $this->field = $field;

                parent::__construct($token);
            }

            protected function setupFields() {
                \PHPUnit_Framework_Assert::assertNull($this->addField($this->field));
            }
        });
    }

    /**
     * @covers CodeCollab\Form\BaseForm::__construct
     * @covers CodeCollab\Form\BaseForm::addField
     * @covers CodeCollab\Form\BaseForm::bindRequest
     */
    public function testBindRequest()
    {
        $token = $this->createMock(Token::class);
        $field = $this->createMock(Field::class);

        $field
            ->expects($this->once())
            ->method('getName')
            ->willReturn('testfield')
        ;

        $field
            ->expects($this->once())
            ->method('setValue')
            ->with($this->equalTo('testvalue'))
        ;

        $request = $this->createMock(Request::class, [], [], '', false);

        $request
            ->expects($this->once())
            ->method('postArray')
            ->willReturn(['testfield' => 'testvalue'])
        ;

        $form = (new class($token, $field) extends BaseForm {
            private $field;

            public function __construct($token, $field) {
                $this->field = $field;

                parent::__construct($token);
            }

            protected function setupFields() {
                \PHPUnit_Framework_Assert::assertNull($this->addField($this->field));
            }
        });

        $this->assertNull($form->bindRequest($request));
    }

    /**
     * @covers CodeCollab\Form\BaseForm::__construct
     * @covers CodeCollab\Form\BaseForm::isValidated
     */
    public function testIsValidatedNotValidated()
    {
        $token = $this->createMock(Token::class);

        $form = (new class($token) extends BaseForm {
            private $field;

            public function __construct($token) {
                parent::__construct($token);
            }

            protected function setupFields() {
                // empty on purpose
            }
        });

        $this->assertFalse($form->isValidated());
    }

    /**
     * @covers CodeCollab\Form\BaseForm::__construct
     * @covers CodeCollab\Form\BaseForm::isValidated
     * @covers CodeCollab\Form\BaseForm::validate
     */
    public function testIsValidatedValidated()
    {
        $token = $this->createMock(Token::class);

        $form = (new class($token) extends BaseForm {
            private $field;

            public function __construct($token) {
                parent::__construct($token);
            }

            protected function setupFields() {
                // empty on purpose
            }
        });

        $form->validate();

        $this->assertTrue($form->isValidated());
    }

    /**
     * @covers CodeCollab\Form\BaseForm::__construct
     * @covers CodeCollab\Form\BaseForm::addField
     * @covers CodeCollab\Form\BaseForm::validate
     * @covers CodeCollab\Form\BaseForm::isValid
     */
    public function testIsValidNotValid()
    {
        $token = $this->createMock(Token::class);
        $field = $this->createMock(Field::class);

        $field
            ->expects($this->once())
            ->method('getName')
            ->willReturn('testfield')
        ;

        $field
            ->expects($this->once())
            ->method('validate')
        ;

        $field
            ->expects($this->once())
            ->method('isValid')
            ->willReturn(false)
        ;

        $form = (new class($token, $field) extends BaseForm {
            private $field;

            public function __construct($token, $field) {
                $this->field = $field;

                parent::__construct($token);
            }

            protected function setupFields() {
                \PHPUnit_Framework_Assert::assertNull($this->addField($this->field));
            }
        });

        $form->validate();

        $this->assertFalse($form->isValid());
    }

    /**
     * @covers CodeCollab\Form\BaseForm::__construct
     * @covers CodeCollab\Form\BaseForm::addField
     * @covers CodeCollab\Form\BaseForm::validate
     * @covers CodeCollab\Form\BaseForm::isValid
     */
    public function testIsValidValid()
    {
        $token = $this->createMock(Token::class);
        $field = $this->createMock(Field::class);

        $field
            ->expects($this->once())
            ->method('getName')
            ->willReturn('testfield')
        ;

        $field
            ->expects($this->once())
            ->method('validate')
        ;

        $field
            ->expects($this->once())
            ->method('isValid')
            ->willReturn(true)
        ;

        $form = (new class($token, $field) extends BaseForm {
            private $field;

            public function __construct($token, $field) {
                $this->field = $field;

                parent::__construct($token);
            }

            protected function setupFields() {
                \PHPUnit_Framework_Assert::assertNull($this->addField($this->field));
            }
        });

        $form->validate();

        $this->assertTrue($form->isValid());
    }

    /**
     * @covers CodeCollab\Form\BaseForm::__construct
     * @covers CodeCollab\Form\BaseForm::offsetExists
     */
    public function testOffsetExistsDoesntExist()
    {
        $form = $this->getMockForAbstractClass(BaseForm::class, [], '', false);

        $this->assertFalse($form->offsetExists('foobar'));
    }

    /**
     * @covers CodeCollab\Form\BaseForm::__construct
     * @covers CodeCollab\Form\BaseForm::offsetExists
     */
    public function testOffsetExistsDoesExist()
    {
        $token = $this->createMock(Token::class);
        $field = $this->createMock(Field::class);

        $field
            ->expects($this->once())
            ->method('getName')
            ->willReturn('testfield')
        ;

        $form = (new class($token, $field) extends BaseForm {
            private $field;

            public function __construct($token, $field) {
                $this->field = $field;

                parent::__construct($token);
            }

            protected function setupFields() {
                \PHPUnit_Framework_Assert::assertNull($this->addField($this->field));
            }
        });

        $this->assertTrue($form->offsetExists('testfield'));
    }

    /**
     * @covers CodeCollab\Form\BaseForm::__construct
     * @covers CodeCollab\Form\BaseForm::offsetExists
     * @covers CodeCollab\Form\BaseForm::offsetGet
     */
    public function testOffsetGetWhenNotSet()
    {
        $form = $this->getMockForAbstractClass(BaseForm::class, [], '', false);

        $this->assertNull($form->offsetGet('foobar'));
    }

    /**
     * @covers CodeCollab\Form\BaseForm::__construct
     * @covers CodeCollab\Form\BaseForm::offsetExists
     * @covers CodeCollab\Form\BaseForm::offsetGet
     */
    public function testOffsetGetDoesExist()
    {
        $token = $this->createMock(Token::class);
        $field = $this->createMock(Field::class);

        $field
            ->expects($this->once())
            ->method('getName')
            ->willReturn('testfield')
        ;

        $form = (new class($token, $field) extends BaseForm {
            private $field;

            public function __construct($token, $field) {
                $this->field = $field;

                parent::__construct($token);
            }

            protected function setupFields() {
                \PHPUnit_Framework_Assert::assertNull($this->addField($this->field));
            }
        });

        $this->assertInstanceOf(Field::class, $form->offsetGet('testfield'));
    }

    /**
     * @covers CodeCollab\Form\BaseForm::__construct
     * @covers CodeCollab\Form\BaseForm::offsetSet
     */
    public function testOffsetSetThrowsWhenCalled()
    {
        $form = $this->getMockForAbstractClass(BaseForm::class, [], '', false);

        $this->expectException(OutOfScopeException::class);
        $this->expectExceptionMessage('Not allowed to set new data directly.');

        $form->offsetSet('offset', 'value');
    }

    /**
     * @covers CodeCollab\Form\BaseForm::__construct
     * @covers CodeCollab\Form\BaseForm::offsetUnset
     */
    public function testOffsetUnsetThrowsWhenCalled()
    {
        $form = $this->getMockForAbstractClass(BaseForm::class, [], '', false);

        $this->expectException(OutOfScopeException::class);
        $this->expectExceptionMessage('Not allowed to use unset directly.');

        $form->offsetUnset('offset');
    }

    /**
     * @covers CodeCollab\Form\BaseForm::__construct
     * @covers CodeCollab\Form\BaseForm::getFieldset
     */
    public function testGetFieldset()
    {
        $form = $this->getMockForAbstractClass(BaseForm::class, [], '', false);

        $this->assertSame([], $form->getFieldset());
    }
}
