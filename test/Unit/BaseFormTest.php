<?php declare(strict_types=1);

namespace CodeCollabTest\Unit\Form;

use CodeCollab\Form\BaseForm;

class BaseFormTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers CodeCollab\Form\BaseForm::__construct
     */
    public function testImplementsCorrectInterfaces()
    {
        $form = $this->getMockForAbstractClass('CodeCollab\Form\BaseForm', [], '', false);

        $this->assertInstanceOf('CodeCollab\Form\Form', $form);
        $this->assertInstanceOf('ArrayAccess', $form);
    }

    /**
     * @covers CodeCollab\Form\BaseForm::__construct
     * @covers CodeCollab\Form\BaseForm::addField
     */
    public function testAddField()
    {
        $token = $this->getMock('CodeCollab\CsrfToken\Token');
        $field = $this->getMock('CodeCollab\Form\Field\Field');

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
        $token = $this->getMock('CodeCollab\CsrfToken\Token');
        $field = $this->getMock('CodeCollab\Form\Field\Field');

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

        $request = $this->getMock('CodeCollab\Http\Request\Request', [], [], '', false);

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
     * @covers CodeCollab\Form\BaseForm::addField
     * @covers CodeCollab\Form\BaseForm::isValid
     */
    public function testIsValidNotValid()
    {
        $token = $this->getMock('CodeCollab\CsrfToken\Token');
        $field = $this->getMock('CodeCollab\Form\Field\Field');

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

        $this->assertFalse($form->isValid());
    }

    /**
     * @covers CodeCollab\Form\BaseForm::__construct
     * @covers CodeCollab\Form\BaseForm::addField
     * @covers CodeCollab\Form\BaseForm::isValid
     */
    public function testIsValidValid()
    {
        $token = $this->getMock('CodeCollab\CsrfToken\Token');
        $field = $this->getMock('CodeCollab\Form\Field\Field');

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

        $this->assertTrue($form->isValid());
    }

    /**
     * @covers CodeCollab\Form\BaseForm::__construct
     * @covers CodeCollab\Form\BaseForm::offsetExists
     */
    public function testOffsetExistsDoesntExist()
    {
        $form = $this->getMockForAbstractClass('CodeCollab\Form\BaseForm', [], '', false);

        $this->assertFalse($form->offsetExists('foobar'));
    }

    /**
     * @covers CodeCollab\Form\BaseForm::__construct
     * @covers CodeCollab\Form\BaseForm::offsetExists
     */
    public function testOffsetExistsDoesExist()
    {
        $token = $this->getMock('CodeCollab\CsrfToken\Token');
        $field = $this->getMock('CodeCollab\Form\Field\Field');

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
        $form = $this->getMockForAbstractClass('CodeCollab\Form\BaseForm', [], '', false);

        $this->assertNull($form->offsetGet('foobar'));
    }

    /**
     * @covers CodeCollab\Form\BaseForm::__construct
     * @covers CodeCollab\Form\BaseForm::offsetExists
     * @covers CodeCollab\Form\BaseForm::offsetGet
     */
    public function testOffsetGetDoesExist()
    {
        $token = $this->getMock('CodeCollab\CsrfToken\Token');
        $field = $this->getMock('CodeCollab\Form\Field\Field');

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

        $this->assertInstanceOf('CodeCollab\Form\Field\Field', $form->offsetGet('testfield'));
    }

    /**
     * @covers CodeCollab\Form\BaseForm::__construct
     * @covers CodeCollab\Form\BaseForm::offsetSet
     */
    public function testOffsetSetThrowsWhenCalled()
    {
        $form = $this->getMockForAbstractClass('CodeCollab\Form\BaseForm', [], '', false);

        $this->setExpectedException('CodeCollab\Form\OutOfScopeException');

        $form->offsetSet('offset', 'value');
    }

    /**
     * @covers CodeCollab\Form\BaseForm::__construct
     * @covers CodeCollab\Form\BaseForm::offsetUnset
     */
    public function testOffsetUnsetThrowsWhenCalled()
    {
        $form = $this->getMockForAbstractClass('CodeCollab\Form\BaseForm', [], '', false);

        $this->setExpectedException('CodeCollab\Form\OutOfScopeException');

        $form->offsetUnset('offset');
    }

    /**
     * @covers CodeCollab\Form\BaseForm::__construct
     * @covers CodeCollab\Form\BaseForm::getFieldset
     */
    public function testGetFieldset()
    {
        $form = $this->getMockForAbstractClass('CodeCollab\Form\BaseForm', [], '', false);

        $this->assertSame([], $form->getFieldset());
    }
}
