<?php
/**
 * @link    https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\PhpUnit\Test\EntityManagerFactory;

use PHPUnit_Framework_TestCase as TestCase;
use OldTown\Workflow\Spi\Doctrine\EntityManagerFactory\SimpleEntityManagerFactory;
use Doctrine\ORM\EntityManagerInterface;
use ReflectionClass;
use OldTown\Workflow\Spi\Doctrine\EntityManagerFactory\Exception\RuntimeException as EntityManagerFactoryRuntimeException;

/**
 * Class SimpleEntityManagerFactoryTest
 *
 * @package OldTown\Workflow\Spi\Doctrine\PhpUnit\Test\EntityManagerFactory
 */
class SimpleEntityManagerFactoryTest extends TestCase
{
    /**
     * Проверка установки/получения EntityManager
     */
    public function testSetterGetterEntityManager()
    {
        $factory = new SimpleEntityManagerFactory();

        /** @var EntityManagerInterface  $emMock */
        $emMock = $this->getMock(EntityManagerInterface::class);

        static::assertEquals($factory, $factory->setEntityManager($emMock));
        static::assertEquals($emMock, $factory->getEntityManager());
    }

    /**
     * Проверка установки/получения EntityManager по умолчанию
     *
     */
    public function testGetDefaultEntityManagerInvalidManager()
    {
        $r = new ReflectionClass(SimpleEntityManagerFactory::class);

        $defaultEntityManagerProperty = $r->getProperty('defaultEntityManager');
        $defaultEntityManagerProperty->setAccessible(true);
        $originalValue = $defaultEntityManagerProperty->getValue();

        $defaultEntityManagerProperty->setValue(null, null);

        $expectedException = null;

        try {
            SimpleEntityManagerFactory::getDefaultEntityManager();
        } catch (\Exception $e) {
            $expectedException = $e;
        }

        static::assertInstanceOf(EntityManagerFactoryRuntimeException::class, $expectedException);


        $defaultEntityManagerProperty->setValue(null, $originalValue);
    }


    /**
     * Проверка установки/получения EntityManager по умолчанию
     *
     */
    public function testSetterGetterDefaultEntityManager()
    {
        $r = new ReflectionClass(SimpleEntityManagerFactory::class);

        $defaultEntityManagerProperty = $r->getProperty('defaultEntityManager');
        $defaultEntityManagerProperty->setAccessible(true);
        $originalValue = $defaultEntityManagerProperty->getValue();

        /** @var EntityManagerInterface $mockEm */
        $mockEm = $this->getMock(EntityManagerInterface::class);
        /** @noinspection PhpVoidFunctionResultUsedInspection */
        static::assertEquals(null, SimpleEntityManagerFactory::setDefaultEntityManager($mockEm));
        static::assertEquals($mockEm, SimpleEntityManagerFactory::getDefaultEntityManager());

        $defaultEntityManagerProperty->setValue(null, $originalValue);
    }


    /**
     * Проверка установки/получения EntityManager по умолчанию
     *
     */
    public function testFactory()
    {
        $factory = new SimpleEntityManagerFactory();

        /** @var EntityManagerInterface  $emMock */
        $emMock = $this->getMock(EntityManagerInterface::class);

        $factory->setEntityManager($emMock);
        static::assertEquals($emMock, $factory->factory());
    }

    /**
     * Проверка установки/получения EntityManager по умолчанию
     *
     */
    public function testFactoryUseDefaultEntityManager()
    {
        $factory = new SimpleEntityManagerFactory();

        $r = new ReflectionClass(SimpleEntityManagerFactory::class);

        $defaultEntityManagerProperty = $r->getProperty('defaultEntityManager');
        $defaultEntityManagerProperty->setAccessible(true);
        $originalValue = $defaultEntityManagerProperty->getValue();

        /** @var EntityManagerInterface  $defaultEmMock */
        $defaultEmMock = $this->getMock(EntityManagerInterface::class);
        SimpleEntityManagerFactory::setDefaultEntityManager($defaultEmMock);

        static::assertEquals($defaultEmMock, $factory->factory());

        $defaultEntityManagerProperty->setValue(null, $originalValue);
    }
}
