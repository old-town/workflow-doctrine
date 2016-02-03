<?php
/**
 * @link    https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine;

use DateTime;
use ReflectionClass;
use OldTown\Workflow\Query\WorkflowExpressionQuery;
use OldTown\Workflow\Spi\StepInterface;
use OldTown\Workflow\Spi\WorkflowStoreInterface;
use Doctrine\ORM\EntityManagerInterface;
use OldTown\Workflow\Spi\Doctrine\EntityManagerFactory\EntityManagerFactoryInterface;
use OldTown\Workflow\Spi\WorkflowEntryInterface;
use OldTown\Workflow\Spi\Doctrine\Entity\Entry;
use OldTown\Workflow\Spi\Doctrine\Entity\CurrentStep;
use OldTown\Workflow\Spi\Doctrine\EntityRepository\StepRepository;

/**
 * Class DoctrineWorkflowStory
 *
 * @package OldTown\Workflow\Spi\Doctrine
 */
class DoctrineWorkflowStory implements  WorkflowStoreInterface
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var EntityManagerFactoryInterface
     */
    protected $entityManagerFactory;

    /**
     * @var string
     */
    protected $entityManagerFactoryName;

    /**
     * @var array
     */
    protected $entityManagerFactoryOptions = [];

    /**
     * Ключ по котормоу можно получить настройки для работы с фабрикой создающей менеджер сущностей
     *
     * @var string
     */
    const ENTITY_MANAGER_FACTORY = 'entityManagerFactory';

    /**
     * Ключ по котормоу можно получить имя класса фабрика создающей менеджер сущностей
     *
     * @var string
     */
    const ENTITY_MANAGER_FACTORY_NAME = 'name';

    /**
     * Ключ по котормоу можно получить параметры для создания менеджера сущностей
     *
     * @var string
     */
    const ENTITY_MANAGER_FACTORY_OPTIONS = 'options';

    /**
     * Инициализация хранилища
     *
     * @param array $props
     *
     * @throws Exception\InvalidArgumentException
     * @throws Exception\RuntimeException
     */
    public function init(array $props = [])
    {
        $this->entityManagerFactory = null;
        $this->entityManager = null;

        if (!array_key_exists(static::ENTITY_MANAGER_FACTORY, $props)) {
            $errMsg = sprintf('Option %s not found', static::ENTITY_MANAGER_FACTORY);
            throw new Exception\InvalidArgumentException($errMsg);
        }

        $emFactoryOptions = $props[static::ENTITY_MANAGER_FACTORY];
        if (!is_array($emFactoryOptions)) {
            $errMsg = sprintf('Option %s is not array', static::ENTITY_MANAGER_FACTORY);
            throw new Exception\InvalidArgumentException($errMsg);
        }


        if (!array_key_exists(static::ENTITY_MANAGER_FACTORY_NAME, $emFactoryOptions)) {
            $errMsg = sprintf('Option %s->%s not found', static::ENTITY_MANAGER_FACTORY, static::ENTITY_MANAGER_FACTORY_NAME);
            throw new Exception\InvalidArgumentException($errMsg);
        }
        $this->entityManagerFactoryName = $emFactoryOptions[static::ENTITY_MANAGER_FACTORY_NAME];

        if (array_key_exists(static::ENTITY_MANAGER_FACTORY_OPTIONS, $emFactoryOptions) && is_array($emFactoryOptions[static::ENTITY_MANAGER_FACTORY_OPTIONS])) {
            $this->entityManagerFactoryOptions = $emFactoryOptions[static::ENTITY_MANAGER_FACTORY_OPTIONS];
        }
    }

    /**
     * @return EntityManagerFactoryInterface
     *
     * @throws Exception\InvalidArgumentException
     * @throws Exception\RuntimeException
     */
    public function getEntityManagerFactory()
    {
        if ($this->entityManagerFactory) {
            return $this->entityManagerFactory;
        }

        if (!class_exists($this->entityManagerFactoryName)) {
            $errMsg = sprintf('Entity manager factory "%s" not found', $this->entityManagerFactoryName);
            throw new Exception\RuntimeException($errMsg);
        }

        $r = new ReflectionClass($this->entityManagerFactoryName);
        if (!$r->implementsInterface(EntityManagerFactoryInterface::class)) {
            $errMsg = sprintf('Factory not implement %s', EntityManagerFactoryInterface::class);
            throw new Exception\RuntimeException($errMsg);
        }

        /** @var EntityManagerFactoryInterface $factory */
        $this->entityManagerFactory = $r->newInstance();

        return $this->entityManagerFactory;
    }

    /**
     * @return EntityManagerInterface
     *
     * @throws Exception\DoctrineRuntimeException
     */
    public function getEntityManager()
    {
        if ($this->entityManager) {
            return $this->entityManager;
        }

        try {
            $em = $this->getEntityManagerFactory()->factory($this->entityManagerFactoryOptions);

            if (!$em instanceof EntityManagerInterface) {
                $errMsg = sprintf('EntityManager not implement %s', EntityManagerInterface::class);
                throw new Exception\RuntimeException($errMsg);
            }
            $this->entityManager = $em;


        } catch (\Exception $e) {
            throw new Exception\DoctrineRuntimeException($e->getMessage(), $e->getCode(), $e);
        }

        return $this->entityManager;
    }


    /**
     * @param string $workflowName
     *
     * @return WorkflowEntryInterface
     *
     * @throws Exception\DoctrineRuntimeException
     */
    public function createEntry($workflowName)
    {
        $workflowEntry = new Entry();
        $workflowEntry->setWorkflowName($workflowName);
        $workflowEntry->setState(WorkflowEntryInterface::CREATED);

        $em = $this->getEntityManager();
        $em->persist($workflowEntry);
        $em->flush();

        return $workflowEntry;
    }

    /**
     * @param int $entryId
     * @param int $state
     *
     * @throws Exception\DoctrineRuntimeException
     */
    public function setEntryState($entryId, $state)
    {
        $em = $this->getEntityManager();

        /** @var Entry $entry */
        $entry = $em->getRepository(Entry::class)->find($entryId);
        $entry->setState($state);

        $em->flush();
    }

    /**
     *
     *
     * @param int      $entryId
     * @param int      $stepId
     * @param string   $owner
     * @param DateTime $startDate
     * @param DateTime $dueDate
     * @param string   $status
     * @param array    $previousIds
     *
     * @return StepInterface|void
     *
     * @throws Exception\DoctrineRuntimeException
     * @throws \OldTown\Workflow\Spi\Doctrine\EntityRepository\Exception\RuntimeException
     * @throws \OldTown\Workflow\Spi\Doctrine\Entity\Exception\InvalidArgumentException
     */
    public function createCurrentStep($entryId, $stepId, $owner, DateTime $startDate, DateTime $dueDate, $status, array $previousIds = [])
    {
        $em = $this->getEntityManager();

        /** @var Entry $entry */
        $entry = $em->getRepository(Entry::class)->find($entryId);

        $currentStep = new CurrentStep();
        $currentStep->setEntry($entry);
        $currentStep->setStepId($stepId);
        $currentStep->setOwner($owner);
        $currentStep->setStartDate($startDate);
        $currentStep->setDueDate($dueDate);
        $currentStep->setStatus($status);

        if (count($previousIds) > 0) {
            /** @var StepRepository $previousStepRepository */
            $previousStepRepository = $em->getRepository(CurrentStep::class);
            $previousSteps = $previousStepRepository->findByIds($previousIds);
            $currentStep->setPreviousSteps($previousSteps);
        }
        $em->persist($currentStep);
        $em->flush();

        $id = $currentStep->getId();

        return $id;
    }












    public function getPropertySet($entryId)
    {
        // TODO: Implement getPropertySet() method.
    }



    public function findCurrentSteps($entryId)
    {
        // TODO: Implement findCurrentSteps() method.
    }

    public function findEntry($entryId)
    {
        // TODO: Implement findEntry() method.
    }

    public function findHistorySteps($entryId)
    {
        // TODO: Implement findHistorySteps() method.
    }

    public function markFinished(StepInterface $step, $actionId, DateTime $finishDate, $status, $caller)
    {
        // TODO: Implement markFinished() method.
    }

    public function moveToHistory(StepInterface $step)
    {
        // TODO: Implement moveToHistory() method.
    }

    public function query(WorkflowExpressionQuery $query)
    {
        // TODO: Implement query() method.
    }

}
