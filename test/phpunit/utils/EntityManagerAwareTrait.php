<?php
/**
 * @link https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\PhpUnit\Utils;

use Doctrine\ORM\EntityManager;

/**
 * Interface EntityManagerAwareTrait
 *
 * @package OldTown\Workflow\Spi\Doctrine\PhpUnit\Utils
 */
trait EntityManagerAwareTrait
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @param EntityManager $entityManager
     *
     * @return $this
     */
    public function setEntityManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        return $this;
    }

    /**
     * @return EntityManager
     *
     * @throws \RuntimeException
     */
    public function getEntityManager()
    {
        if (!$this->entityManager instanceof EntityManager) {
            $errMsg = 'EntityManager not found';
            throw new \RuntimeException($errMsg);
        }

        return $this->entityManager;
    }

    /**
     * @return boolean
     */
    public function hasEntityManager()
    {
        $flag = $this->entityManager instanceof EntityManager;
        return $flag;
    }
}
