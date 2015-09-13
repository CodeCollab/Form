<?php declare(strict_types=1);

namespace CodeCollabTest\Unit\Form\Field;

use CodeCollab\Form\Field\Csrf;

class CsrfTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers CodeCollab\Form\Field\Csrf::__construct
     */
    public function testImplementsCorrectInterface()
    {
        $field = new Csrf('csrffield');

        $this->assertInstanceOf('CodeCollab\Form\Field\Field', $field);
        $this->assertSame('csrffield', $field->getName());
        $this->assertSame('csrf', $field->getType());
    }

    /**
     * @covers CodeCollab\Form\Field\Csrf::__construct
     * @covers CodeCollab\Form\Field\Csrf::getValue
     */
    public function testGetValueEmptyStringWhenNoDefaultValueIsSupplied()
    {
        $field = new Csrf('csrffield');

        $this->assertSame('', $field->getValue());
    }

    /**
     * @covers CodeCollab\Form\Field\Csrf::__construct
     * @covers CodeCollab\Form\Field\Csrf::getValue
     */
    public function testGetValueReturnsDefaultValueEvenWhenValueIsManuallySet()
    {
        $field = new Csrf('csrffield', [], 'defaultvalue');

        $field->setValue('custom value');

        $this->assertSame('defaultvalue', $field->getValue());
    }
}
