<?php
/**
 * @link    https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\PhpUnit\Test;

use OldTown\Workflow\Spi\Doctrine\PhpUnit\Utils\EntityManagerAwareTrait;
use PHPUnit_Framework_TestCase as TestCase;
use OldTown\Workflow\Spi\Doctrine\PhpUnit\Utils\DirUtilTrait;
use OldTown\Workflow\Spi\Doctrine\PhpUnit\Utils\EntityManagerAwareInterface;
use OldTown\Workflow\Spi\Doctrine\PhpUnit\Utils\DbTrait;

/**
 * Class DoctrineWorkflowFactoryTest
 *
 * @package OldTown\Workflow\Spi\Doctrine\PhpUnit\Test
 */
class DoctrineWorkflowFactoryTest extends TestCase implements EntityManagerAwareInterface
{
    use DirUtilTrait, DbTrait, EntityManagerAwareTrait;

    public function testFactory()
    {
        $this->createSchema();
    }
}
