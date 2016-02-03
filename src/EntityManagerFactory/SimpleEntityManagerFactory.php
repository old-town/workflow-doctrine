<?php
/**
 * @link    https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\EntityManagerFactory;

use \Doctrine\ORM\EntityManagerInterface;

/**
 * Interface EntityManagerFactoryInterface
 *
 * @package OldTown\Workflow\Spi\Doctrine\EntityManagerFactory
 */
class SimpleEntityManagerFactory implements EntityManagerFactoryInterface
{
    /**
     * @var EntityManagerInterface
     */
    protected static $defaultEntityManager;

    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * Создает менеджер сущностей доктрины
     *
     * @param array $options
     *
     * @return EntityManagerInterface
     *
     * @throws Exception\RuntimeException
     */
    public function factory(array $options = [])
    {
        $em = $this->getEntityManager();
        if ($em) {
            return $em;
        }
        return static::getDefaultEntityManager();
    }

    /**
     * @return EntityManagerInterface
     *
     * @throws Exception\RuntimeException
     */
    public static function getDefaultEntityManager()
    {
        if (!static::$defaultEntityManager instanceof EntityManagerInterface) {
            $errMsg = 'Entity Manager not found';
            throw new Exception\RuntimeException($errMsg);
        }
        return static::$defaultEntityManager;
    }

    /**
     * @param EntityManagerInterface $defaultEntityManager
     */
    public static function setDefaultEntityManager(EntityManagerInterface $defaultEntityManager)
    {
        static::$defaultEntityManager = $defaultEntityManager;
    }

    /**
     * @return EntityManagerInterface
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * @param EntityManagerInterface $entityManager
     *
     * @return $this
     */
    public function setEntityManager(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

        return $this;
    }


}
