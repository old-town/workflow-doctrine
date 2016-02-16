<?php
/**
 * @link    https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use OldTown\Workflow\Spi\WorkflowEntryInterface;

/**
 * Interface EntryInterface
 *
 * @package OldTown\Workflow\Spi\Doctrine\Entity
 */
interface EntryInterface extends WorkflowEntryInterface
{
    /**
     * @param string $id
     *
     * @return $this
     */
    public function setId($id);

    /**
     * @param string $workflowName
     *
     * @return $this
     */
    public function setWorkflowName($workflowName);

    /**
     * @param integer $state
     *
     * @return $this
     */
    public function setState($state);


    /**
     * @return ArrayCollection|CurrentStepInterface[]
     */
    public function getCurrentSteps();

    /**
     * @param CurrentStepInterface $currentStep
     *
     * @return $this
     */
    public function addCurrentStep(CurrentStepInterface $currentStep);

    /**
     * @return ArrayCollection|HistoryStepInterface[]
     */
    public function getHistorySteps();

    /**
     * @param HistoryStepInterface $historyStep
     *
     * @return $this
     */
    public function addHistoryStep(HistoryStepInterface $historyStep);
}
