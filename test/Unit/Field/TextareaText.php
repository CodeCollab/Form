<?php declare(strict_types=1);

namespace CodeCollabTest\Unit\Form\Field;

use CodeCollab\Form\Field\Textarea;

class TextareaTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers CodeCollab\Form\Field\Textarea::__construct
     */
    public function testImplementsCorrectInterface()
    {
        $field = new Textarea('textareafield');

        $this->assertInstanceOf('CodeCollab\Form\Field\Field', $field);
        $this->assertSame('textareafield', $field->getName());
        $this->assertSame('textarea', $field->getType());
    }
}
