<?php
/**
 * @link    https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\PhpUnit\Test\Entity;

use PHPUnit_Framework_TestCase as TestCase;
use OldTown\Workflow\Spi\Doctrine\Entity\Entry;
use OldTown\Workflow\Spi\Doctrine\Entity\CurrentStep;
use OldTown\Workflow\Spi\Doctrine\Entity\HistoryStep;

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

    /**
     * Работа с текущими шагами
     */
    public function testCurrentStep()
    {
        /** @var CurrentStep $currentStep */
        $currentStep = $this->getMock(CurrentStep::class);

        static::assertEquals($this->entry, $this->entry->addCurrentStep($currentStep));
        static::assertEquals($this->entry, $this->entry->addCurrentStep($currentStep));
        static::assertEquals($this->entry, $this->entry->addCurrentStep($currentStep));

        static::assertEquals($currentStep, $this->entry->getCurrentSteps()->current());
        static::assertCount(1, $this->entry->getCurrentSteps());
    }


    /**
     * Работа с шагами истории
     */
    public function testHistorySteps()
    {
        /** @var HistoryStep $historyStep */
        $historyStep = $this->getMock(HistoryStep::class, [], [], '', false);

        static::assertEquals($this->entry, $this->entry->addHistoryStep($historyStep));
        static::assertEquals($this->entry, $this->entry->addHistoryStep($historyStep));
        static::assertEquals($this->entry, $this->entry->addHistoryStep($historyStep));

        static::assertEquals($historyStep, $this->entry->getHistorySteps()->current());
        static::assertCount(1, $this->entry->getHistorySteps());
    }
}
