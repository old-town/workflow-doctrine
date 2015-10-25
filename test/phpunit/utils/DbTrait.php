<?php
/**
 * @link https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\PhpUnit\Utils;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\SchemaTool;

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

        $tool = new SchemaTool($em);
        $metadata = $em->getMetadataFactory()->getAllMetadata();
        $tool->createSchema($metadata);
    }
}
