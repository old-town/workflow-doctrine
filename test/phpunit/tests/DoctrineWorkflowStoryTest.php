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
use OldTown\Workflow\Spi\Doctrine\DoctrineWorkflowStory;
use OldTown\Workflow\Spi\Doctrine\EntityManagerFactory\EntityManagerFactoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit_Framework_MockObject_MockObject;

/**
 * Class DoctrineWorkflowStoryTest
 *
 * @package OldTown\Workflow\Spi\Doctrine\PhpUnit\Test
 */
class DoctrineWorkflowStoryTest extends TestCase implements EntityManagerAwareInterface
{
    use DirUtilTrait, DbTrait, EntityManagerAwareTrait;

    /**
     * Подготавливаем базу
     *
     */
    protected function setUp()
    {
        $schemaManager = $this->getEntityManager()->getConnection()->getSchemaManager();
        $tables = $schemaManager->listTableNames();

        foreach ($tables as $table) {
            $schemaManager->dropTable($table);
        }

        $this->createSchema();

        parent::setUp();

    }

    /**
     * При попытке инициировать адаптер для работы с доктриной, в случае если не указаны настройки
     * для фабрики создающий менеджер сущностей, бросаем исключение
     *
     *
     * @expectedException \OldTown\Workflow\Spi\Doctrine\Exception\InvalidArgumentException
     * @expectedExceptionMessage Option entityManagerFactory not found
     */
    public function testInitEntityManagerFactoryConfigNotExists()
    {
        $doctrineWorkflowStory = new DoctrineWorkflowStory();
        $doctrineWorkflowStory->init();
    }


    /**
     * Настройки фабрики создающей менеджер сущностей доктрины должны быть массивом
     *
     *
     * @expectedException \OldTown\Workflow\Spi\Doctrine\Exception\InvalidArgumentException
     * @expectedExceptionMessage Option entityManagerFactory is not array
     */
    public function testInitEntityManagerFactoryConfigNotArray()
    {
        $doctrineWorkflowStory = new DoctrineWorkflowStory();
        $doctrineWorkflowStory->init([
            DoctrineWorkflowStory::ENTITY_MANAGER_FACTORY => 'not_array'
        ]);
    }

    /**
     * В настройках фабрики создающей менеджер сущностей доктрины  должен быть обязательно
     * указан класс фабрики
     *
     *
     * @expectedException \OldTown\Workflow\Spi\Doctrine\Exception\InvalidArgumentException
     * @expectedExceptionMessage Option entityManagerFactory->name not found
     */
    public function testInitEntityManagerFactoryNameNotFound()
    {
        $doctrineWorkflowStory = new DoctrineWorkflowStory();
        $doctrineWorkflowStory->init([
            DoctrineWorkflowStory::ENTITY_MANAGER_FACTORY => [

            ]
        ]);
    }

    /**
     * В случае если для фабрики создающей сущности доктрины указан несуществующий класс, то
     * должно бросаться исключение
     *
     * @expectedException \OldTown\Workflow\Spi\Doctrine\Exception\RuntimeException
     * @expectedExceptionMessage Entity manager factory "incorrect class name" not found
     */
    public function testGetEntityManagerFactoryClassNotFound()
    {

        $doctrineWorkflowStory = new DoctrineWorkflowStory();
        $doctrineWorkflowStory->init([
            DoctrineWorkflowStory::ENTITY_MANAGER_FACTORY => [
                DoctrineWorkflowStory::ENTITY_MANAGER_FACTORY_NAME => 'incorrect class name'
            ]
        ]);
        $doctrineWorkflowStory->getEntityManagerFactory();
    }


    /**
     * В случае если фабрика для создания сущностей доктрины не реализует заданный интрефейс,
     * должно бросаться исключение
     *
     * @expectedException \OldTown\Workflow\Spi\Doctrine\Exception\RuntimeException
     * @expectedExceptionMessage Factory not implement OldTown\Workflow\Spi\Doctrine\EntityManagerFactory\EntityManagerFactoryInterface
     */
    public function testGetEntityManagerFactoryInvalidClass()
    {

        $doctrineWorkflowStory = new DoctrineWorkflowStory();
        $doctrineWorkflowStory->init([
            DoctrineWorkflowStory::ENTITY_MANAGER_FACTORY => [
                DoctrineWorkflowStory::ENTITY_MANAGER_FACTORY_NAME => \stdClass::class
            ]
        ]);
        $doctrineWorkflowStory->getEntityManagerFactory();
    }

    /**
     * Проверка создания фабрики отвечающей за порождение менеджера сущностей доктрины
     *
     */
    public function testGetEntityManagerFactory()
    {
        $factoryMock = $this->getMockClass(EntityManagerFactoryInterface::class);

        $doctrineWorkflowStory = new DoctrineWorkflowStory();
        $doctrineWorkflowStory->init([
            DoctrineWorkflowStory::ENTITY_MANAGER_FACTORY => [
                DoctrineWorkflowStory::ENTITY_MANAGER_FACTORY_NAME => $factoryMock
            ]
        ]);
        $factory = $doctrineWorkflowStory->getEntityManagerFactory();

        static::assertInstanceOf($factoryMock, $factory);
    }


    /**
     * Проверка создания фабрики отвечающей за порождение менеджера сущностей доктрины
     *
     */
    public function testGetEntityManager()
    {
        $factoryMock = $this->getMockClass(EntityManagerFactoryInterface::class, ['factory']);

        $factoryOptions = [
            'key1' => 'value1',
            'key2' => 'value2',
            'key3' => 'value3'
        ];

        $doctrineWorkflowStory = new DoctrineWorkflowStory();
        $doctrineWorkflowStory->init([
            DoctrineWorkflowStory::ENTITY_MANAGER_FACTORY => [
                DoctrineWorkflowStory::ENTITY_MANAGER_FACTORY_NAME => $factoryMock,
                DoctrineWorkflowStory::ENTITY_MANAGER_FACTORY_OPTIONS => $factoryOptions
            ]
        ]);
        /** @var EntityManagerFactoryInterface|PHPUnit_Framework_MockObject_MockObject $factoryMock */
        $factoryMock = $doctrineWorkflowStory->getEntityManagerFactory();

        $factoryMock->expects(static::once())
                    ->method('factory')
                    ->with(static::equalTo($factoryOptions))
                    ->will(static::returnValue($this->getMock(EntityManagerInterface::class)));

        $em = $doctrineWorkflowStory->getEntityManager();

        static::assertTrue($em instanceof EntityManagerInterface );

        //проверка что работает кеширование
        static::assertTrue($em ===  $doctrineWorkflowStory->getEntityManager());
    }


    /**
     * Проверка создания фабрики отвечающей за порождение менеджера сущностей доктрины
     *
     * @expectedException \OldTown\Workflow\Spi\Doctrine\Exception\DoctrineRuntimeException
     * @expectedExceptionMessage EntityManager not implement Doctrine\ORM\EntityManagerInterface
     */
    public function testGetEntityManagerInvalidResult()
    {
        $factoryMock = $this->getMockClass(EntityManagerFactoryInterface::class, ['factory']);

        $doctrineWorkflowStory = new DoctrineWorkflowStory();
        $doctrineWorkflowStory->init([
            DoctrineWorkflowStory::ENTITY_MANAGER_FACTORY => [
                DoctrineWorkflowStory::ENTITY_MANAGER_FACTORY_NAME => $factoryMock
            ]
        ]);
        /** @var EntityManagerFactoryInterface|PHPUnit_Framework_MockObject_MockObject $factoryMock */
        $factoryMock = $doctrineWorkflowStory->getEntityManagerFactory();

        $factoryMock->expects(static::once())
            ->method('factory')
            ->will(static::returnValue('invalid values'));

        $doctrineWorkflowStory->getEntityManager();
    }
}
