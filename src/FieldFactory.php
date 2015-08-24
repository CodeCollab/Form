<?php declare(strict_types=1);
/**
 * Factory for fields
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

/**
 * Factory for fields
 *
 * @category   CodeCollab
 * @package    Form
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class FieldFactory
{
    /**
     * @var \PDO The database connection
     */
    private $dbConnection;

    /**
     * Creates instance
     *
     * @param \PDO $dbConnection A database connection
     */
    public function __construct(\PDO $dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }

    /**
     * Builds the fieldset
     *
     * @param string $type            The type of the field
     * @param array  $validationRules List of validation rules
     *
     * @return \CodeCollab\Form\Field The built field set
     */
    public function build(string $type, array $validationRules): Field
    {
        return new Field($this->dbConnection, $type, $validationRules);
    }
}
