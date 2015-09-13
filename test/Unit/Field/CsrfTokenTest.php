<?php declare(strict_types=1);

namespace CodeCollabTest\Unit\Form\Field;

use CodeCollab\Form\Field\CsrfToken;

class CsrfTokenTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers CodeCollab\Form\Field\CsrfToken::__construct
     */
    public function testImplementsCorrectInterface()
    {
        $field = new CsrfToken('csrffield');

        $this->assertInstanceOf('CodeCollab\Form\Field\Field', $field);
        $this->assertSame('csrffield', $field->getName());
        $this->assertSame('csrfToken', $field->getType());
    }

    /**
     * @covers CodeCollab\Form\Field\CsrfToken::__construct
     * @covers CodeCollab\Form\Field\CsrfToken::getValue
     */
    public function testGetValueEmptyStringWhenNoDefaultValueIsSupplied()
    {
        $field = new CsrfToken('csrffield');

        $this->assertSame('', $field->getValue());
    }

    /**
     * @covers CodeCollab\Form\Field\CsrfToken::__construct
     * @covers CodeCollab\Form\Field\CsrfToken::getValue
     */
    public function testGetValueReturnsDefaultValueEvenWhenValueIsManuallySet()
    {
        $field = new CsrfToken('csrffield', [], 'defaultvalue');

        $field->setValue('custom value');

        $this->assertSame('defaultvalue', $field->getValue());
    }
}
