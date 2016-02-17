<?php
/**
 * @link    https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * Class WorkflowName
 *
 * @ORM\Entity()
 * @ORM\Table(name="wf_entry")
 * @ORM\InheritanceType(value="SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 *
 * @package OldTown\Workflow\Spi\Doctrine
 */
abstract class AbstractEntry implements EntryInterface
{
    /**
     * @ORM\Id()
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     * @var string
     */
    protected $id;

    /**
     * @ORM\Column(name="workflow_name", type="string", length=60)
     *
     *
     * @var string
     */
    protected $workflowName;


    /**
     * @ORM\Column(name="state", type="integer")
     *
     *
     * @var integer
     */
    protected $state;

    /**
     * @ORM\OneToMany(targetEntity="CurrentStep", mappedBy="entry")
     *
     * @var CurrentStepInterface[]|ArrayCollection
     */
    protected $currentSteps;


    /**
     * @ORM\OneToMany(targetEntity="HistoryStep", mappedBy="entry")
     * @ORM\OrderBy({"finishDate"="ASC"})
     *
     * @var HistoryStepInterface[]|ArrayCollection
     */
    protected $historySteps;


    /**
     *
     */
    public function __construct()
    {
        $this->currentSteps = new ArrayCollection();
        $this->historySteps = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = (integer)$id;

        return $this;
    }

    /**
     * @return string
     */
    public function getWorkflowName()
    {
        return $this->workflowName;
    }

    /**
     * @param string $workflowName
     *
     * @return $this
     */
    public function setWorkflowName($workflowName)
    {
        $this->workflowName = (string)$workflowName;

        return $this;
    }

    /**
     * @return integer
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param integer $state
     *
     * @return $this
     */
    public function setState($state)
    {
        $this->state = (integer)$state;

        return $this;
    }

    /**
     * Определяет иницилазирован ли процесс workflow
     *
     * @return bool
     */
    public function isInitialized()
    {
        return $this->state > 0;
    }

    /**
     * @return ArrayCollection|CurrentStepInterface[]
     */
    public function getCurrentSteps()
    {
        return $this->currentSteps;
    }

    /**
     * @param CurrentStepInterface $currentStep
     *
     * @return $this
     */
    public function addCurrentStep(CurrentStepInterface $currentStep)
    {
        $currentStep->setEntry($this);
        if (!$this->getCurrentSteps()->contains($currentStep)) {
            $this->getCurrentSteps()->add($currentStep);
        }


        return $this;
    }



    /**
     * @return ArrayCollection|HistoryStepInterface[]
     */
    public function getHistorySteps()
    {
        return $this->historySteps;
    }

    /**
     * @param HistoryStepInterface $historyStep
     *
     * @return $this
     */
    public function addHistoryStep(HistoryStepInterface $historyStep)
    {
        $historyStep->setEntry($this);
        if (!$this->getHistorySteps()->contains($historyStep)) {
            $this->getHistorySteps()->add($historyStep);
        }

        return $this;
    }
}
