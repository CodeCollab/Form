<?php declare(strict_types=1);
/**
 * Factory for forms
 *
 * PHP version 7.0
 *
 * @category   CodeCollab
 * @package    Form
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2015 Pieter Hordijk <https://github.com/PeeHaa>
 * @license    See the LICENSE file
 * @version    1.0.0
 */
namespace CodeCollab\Form;

use CodeCollab\CsrfToken\Token;

/**
 * Factory for forms
 *
 * @category   CodeCollab
 * @package    Form
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Factory
{
    /**
     * @var \CodeCollab\CsrfToken\Token CSRF token handler
     */
    private $csrfToken;

    /**
     * @var \CodeCollab\Form\FieldsetFactory The field set factory
     */
    private $fieldsetFactory;

    /**
     * @var \PDO A database connection
     */
    private $dbConnection;

    /**
     * Creates instance
     *
     * @param \CodeCollab\CsrfToken\Token      $csrfToken       CSRF token handler
     * @param \CodeCollab\Form\FieldsetFactory $fieldsetFactory The field set factory
     * @param \PDO                             $dbConnection    A database connection
     */
    public function __construct(Token $csrfToken, FieldsetFactory $fieldsetFactory, \PDO $dbConnection)
    {
        $this->csrfToken       = $csrfToken;
        $this->fieldsetFactory = $fieldsetFactory;
        $this->dbConnection    = $dbConnection;
    }

    /**
     * Builds the form
     *
     * @param string $name The name of the form to build
     *
     * @return \CodeCollab\Form\Form The form
     */
    public function build(string $name): Form
    {
        return $this->buildWithDependencies($name);
    }

    /**
     * Builds the object with dependencies
     *
     * @param string $name The name of the form
     *
     * @return \CodeCollab\Form\Form The built object
     */
    private function buildWithDependencies(string $name): Form
    {
        $class = new \ReflectionClass($name);
        $constructor  = $class->getConstructor();
        $dependencies = $this->getDependencies($constructor->getParameters());

        return $class->newInstanceArgs($dependencies);
    }

    /**
     * Gets dependencies to build the object
     *
     * @param array $parameters The parameters of the constructor
     *
     * @return array The dependencies
     */
    private function getDependencies(array $parameters): array
    {
        $dependencies = [];

        foreach ($parameters as $parameter) {
            $dependencies[] = $this->getDependency($parameter->getClass()->name);
        }

        return $dependencies;
    }

    /**
     * Gets a dependency
     *
     * @param string $name The name of the dependency
     *
     * @return mixed The dependency
     */
    private function getDependency(string $name)
    {
        switch ($name) {
            case 'PDO':
                return $this->dbConnection;

            case 'CodeCollab\CsrfToken\Token';
                return $this->csrfToken;

            case 'CodeCollab\Form\Fieldset';
                return $this->fieldsetFactory->build();
        }
    }
}
