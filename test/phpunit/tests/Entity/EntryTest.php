<?php
/**
 * @link    https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\PhpUnit\Test\Entity;

use PHPUnit_Framework_TestCase as TestCase;
use OldTown\Workflow\Spi\Doctrine\Entity\Entry;

/**
 * Class DoctrineWorkflowStoryFunctionalTest
 *
 * @package OldTown\Workflow\Spi\Doctrine\PhpUnit\Test
 */
class EntryTest extends TestCase
{
    /**
     * @var Entry
     */
    protected $entry;

    /**
     * @return void
     */
    protected function setUp()
    {
        $this->entry = new Entry();
    }

    /**
     * Проверка установки/получения id
     */
    public function testSetterGetterId()
    {
        static::assertEquals($this->entry, $this->entry->setId('3'));
        static::assertEquals(3, $this->entry->getId());
    }

    /**
     * Проверка установки/получения идендификатора определяющего состояние процесса workflow
     */
    public function testSetterGetterState()
    {
        static::assertEquals($this->entry, $this->entry->setState('3'));
        static::assertEquals(3, $this->entry->getState());
    }

    /**
     * Проверка установки/получения имени workflow для которого запущен процесс
     */
    public function testSetterGetterName()
    {
        static::assertEquals($this->entry, $this->entry->setWorkflowName('test_workflow'));
        static::assertEquals('test_workflow', $this->entry->getWorkflowName());
    }

    /**
     * Проверка функционала определяющего был ли иницирован workflow прцоесс
     */
    public function testIsInitialized()
    {
        $this->entry->setState(Entry::CREATED);
        static::assertEquals(false, $this->entry->isInitialized());

        $this->entry->setState(Entry::ACTIVATED);
        static::assertEquals(true, $this->entry->isInitialized());
    }
}
