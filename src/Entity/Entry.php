<?php
/**
 * @link    https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use OldTown\Workflow\Spi\WorkflowEntryInterface;

/**
 * Class WorkflowName
 *
 * @ORM\Entity()
 * @ORM\Table(name="wf_entry")
 *
 * @package OldTown\Workflow\Spi\Doctrine
 */
class Entry implements WorkflowEntryInterface
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
     * @var CurrentStep[]|ArrayCollection
     */
    protected $currentSteps;


    /**
     * @ORM\OneToMany(targetEntity="HistoryStep", mappedBy="entry")
     * @ORM\OrderBy({"finishDate"="ASC"})
     *
     * @var HistoryStep[]|ArrayCollection
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
     * @return ArrayCollection|CurrentStep[]
     */
    public function getCurrentSteps()
    {
        return $this->currentSteps;
    }

    /**
     * @param CurrentStep $currentStep
     *
     * @return $this
     */
    public function addCurrentStep(CurrentStep $currentStep)
    {
        $currentStep->setEntry($this);
        if (!$this->getCurrentSteps()->contains($currentStep)) {
            $this->getCurrentSteps()->add($currentStep);
        }


        return $this;
    }



    /**
     * @return ArrayCollection|HistoryStep[]
     */
    public function getHistorySteps()
    {
        return $this->historySteps;
    }

    /**
     * @param HistoryStep $historyStep
     *
     * @return $this
     */
    public function addHistoryStep(HistoryStep $historyStep)
    {
        $historyStep->setEntry($this);
        if (!$this->getHistorySteps()->contains($historyStep)) {
            $this->getHistorySteps()->add($historyStep);
        }

        return $this;
    }
}
