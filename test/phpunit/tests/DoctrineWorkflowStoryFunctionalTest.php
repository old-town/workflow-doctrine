<?php
/**
 * @link    https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\PhpUnit\Test;

use OldTown\Workflow\Spi\Doctrine\Entity\CurrentStep;
use OldTown\Workflow\Spi\Doctrine\EntityManagerFactory\SimpleEntityManagerFactory;
use OldTown\Workflow\Spi\Doctrine\PhpUnit\Utils\EntityManagerAwareTrait;
use OldTown\Workflow\Spi\WorkflowEntryInterface;
use PHPUnit_Framework_TestCase as TestCase;
use OldTown\Workflow\Spi\Doctrine\PhpUnit\Utils\DirUtilTrait;
use OldTown\Workflow\Spi\Doctrine\PhpUnit\Utils\EntityManagerAwareInterface;
use OldTown\Workflow\Spi\Doctrine\PhpUnit\Utils\DbTrait;
use OldTown\Workflow\Spi\Doctrine\DoctrineWorkflowStory;
use OldTown\Workflow\Spi\Doctrine\Entity\Entry;
use DateTime;

/**
 * Class DoctrineWorkflowStoryFunctionalTest
 *
 * @package OldTown\Workflow\Spi\Doctrine\PhpUnit\Test
 */
class DoctrineWorkflowStoryFunctionalTest extends TestCase implements EntityManagerAwareInterface
{
    use DirUtilTrait, DbTrait, EntityManagerAwareTrait;

    /**
     * @var DoctrineWorkflowStory
     */
    protected $doctrineWorkflowStory;

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

        $this->doctrineWorkflowStory = new DoctrineWorkflowStory();
        $this->doctrineWorkflowStory->init([
            DoctrineWorkflowStory::ENTITY_MANAGER_FACTORY => [
                DoctrineWorkflowStory::ENTITY_MANAGER_FACTORY_NAME => SimpleEntityManagerFactory::class
            ]
        ]);

        /** @var SimpleEntityManagerFactory $factory */
        $factory = $this->doctrineWorkflowStory->getEntityManagerFactory();
        $factory->setEntityManager($this->getEntityManager());

        parent::setUp();

    }

    /**
     * Проверка создания нового процесса workflow
     *
     */
    public function testCreateEntry()
    {
        $workflowName = 'test_workflow_name';
        $entry = $this->doctrineWorkflowStory->createEntry($workflowName);
        static::assertInstanceOf(WorkflowEntryInterface::class, $entry);

        $this->doctrineWorkflowStory->getEntityManager()->clear();

        $results = $this->doctrineWorkflowStory->getEntityManager()->getRepository(Entry::class)->findAll();

        static::assertCount(1, $results);
        /** @var Entry $actualEntry */
        $actualEntry = array_pop($results);

        static::assertEquals($entry->getId(), $actualEntry->getId());

        static::assertEquals($entry->getWorkflowName(), $actualEntry->getWorkflowName());
        static::assertEquals($workflowName, $actualEntry->getWorkflowName());
        static::assertEquals($workflowName, $entry->getWorkflowName());

        static::assertEquals($entry->getState(), $actualEntry->getState());

    }

    /**
     * Проверка изменения состояния процесса workflow
     *
     */
    public function testSetEntryState()
    {
        $workflowName = 'test_workflow_name';
        $wfEntry = $this->doctrineWorkflowStory->createEntry($workflowName);
        $this->doctrineWorkflowStory->setEntryState($wfEntry->getId(), -7);
        $this->doctrineWorkflowStory->getEntityManager()->clear();

        /** @var Entry $entry */
        $entry = $this->doctrineWorkflowStory->getEntityManager()->getRepository(Entry::class)->find($wfEntry->getId());

        static::assertEquals(-7, $entry->getState());
    }

    /**
     * Создать новый шак в процессе workflow
     *
     */
    public function testCreateCurrentStep()
    {
        $entry = $this->doctrineWorkflowStory->createEntry('test_workflow_name');

        $previousIds = [];

        //create step 1
        $stepId = 7;
        $owner = 'test_user_login';
        $startDate = new DateTime();
        $dueDate = new DateTime();
        $status = 'finish';
        $previousIds[] = $this->doctrineWorkflowStory->createCurrentStep($entry->getId(), $stepId, $owner, $startDate, $dueDate, $status);

        //create step 2
        $stepId = 7;
        $owner = 'test_user_login';
        $startDate = new DateTime();
        $dueDate = new DateTime();
        $status = 'finish';
        $previousIds[] = $this->doctrineWorkflowStory->createCurrentStep($entry->getId(), $stepId, $owner, $startDate, $dueDate, $status);


        //create step 3
        $stepId = 7;
        $owner = 'test_user_login';
        $startDate = new DateTime();
        $dueDate = new DateTime();
        $status = 'finish';
        $id = $this->doctrineWorkflowStory->createCurrentStep($entry->getId(), $stepId, $owner, $startDate, $dueDate, $status, $previousIds);

        $em = $this->getEntityManager();
        $em->clear();

        /** @var CurrentStep  $step */
        $step = $em->getRepository(CurrentStep::class)->find($id);

        static::assertEquals($stepId, $step->getStepId());
        static::assertEquals($owner, $step->getOwner());
        static::assertEquals($startDate, $step->getStartDate());
        static::assertEquals($dueDate, $step->getDueDate());
        static::assertEquals($status, $step->getStatus());
        static::assertEquals($entry->getId(), $step->getEntryId());
        static::assertEquals([], array_diff($step->getPreviousStepIds(), $previousIds));



    }
}
