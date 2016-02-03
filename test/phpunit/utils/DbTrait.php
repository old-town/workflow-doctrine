<?php
/**
 * @link https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\PhpUnit\Utils;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\ORM\Tools\SchemaValidator;

error_reporting(E_ALL | E_STRICT);

/**
 * Test bootstrap, for setting up autoloading
 *
 * @subpackage UnitTest
 */
trait DbTrait
{

    /**
     * @return EntityManager
     *
     */
    abstract public function getEntityManager();

    /**
     *  Создает схему БД
     *
     * @throws \Doctrine\ORM\Tools\ToolsException
     */
    public function createSchema()
    {
        $em = $this->getEntityManager();

//        $em->getConnection()->executeQuery('DROP DATABASE `workflow-doctrine`');
//        $em->getConnection()->executeQuery('CREATE DATABASE `workflow-doctrine`');
//        $em->getConnection()->close();
//        $em->getConnection()->connect();

        $validator = new SchemaValidator($em);
        $errors = $validator->validateMapping();
        foreach ($errors as $className => $errorMessages) {
            foreach ($errorMessages as $errorMessage) {
                var_dump($errorMessage);
            }

        }


        $tool = new SchemaTool($em);
        $metadata = $em->getMetadataFactory()->getAllMetadata();
        $tool->dropDatabase();
        $tool->createSchema($metadata);
    }


    /**
     *  Создает схему БД
     *
     * @throws \Doctrine\ORM\Tools\ToolsException
     */
    public function dropSchema()
    {
        $em = $this->getEntityManager();
        $tool = new SchemaTool($em);
        $tool->dropDatabase();
    }
}
