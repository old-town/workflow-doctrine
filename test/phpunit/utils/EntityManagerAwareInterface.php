<?php
/**
 * @link https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\PhpUnit\Utils;

use Doctrine\ORM\EntityManager;

/**
 * Interface EntityManagerAwareInterface
 *
 * @package OldTown\Workflow\Spi\Doctrine\PhpUnit\Utils
 */
interface EntityManagerAwareInterface
{
    /**
     * @param EntityManager $entityManager
     *
     * @return $this
     */
    public function setEntityManager(EntityManager $entityManager);

    /**
     * @return EntityManager
     */
    public function getEntityManager();

    /**
     * @return boolean
     */
    public function hasEntityManager();
}
