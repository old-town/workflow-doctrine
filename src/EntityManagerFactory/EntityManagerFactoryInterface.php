<?php
/**
 * @link    https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\EntityManagerFactory;

use Doctrine\ORM\EntityManagerInterface;

/**
 * Interface EntityManagerFactoryInterface
 *
 * @package OldTown\Workflow\Spi\Doctrine\EntityManagerFactory
 */
interface EntityManagerFactoryInterface
{
    /**
     * Создает менеджер сущностей доктрины
     *
     * @param array $options
     *
     * @return EntityManagerInterface
     */
    public function factory(array $options = []);
}
