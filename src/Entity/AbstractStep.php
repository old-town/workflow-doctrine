<?php
/**
 * @link    https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use DateTime;
use Traversable;


/**
 * Class CurrentStep
 *
 * @package OldTown\Workflow\Spi\Doctrine\Entity
 *
 * @ORM\Entity(repositoryClass="\OldTown\Workflow\Spi\Doctrine\EntityRepository\StepRepository")
 * @ORM\Table(
 *     name="wf_step",
 *     indexes={
 *         @ORM\Index(name="owner", columns={"owner"}),
 *         @ORM\Index(name="caller", columns={"caller"})
 *     }
 * )
 * @ORM\InheritanceType(value="SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap(value={"currentStep" = "CurrentStep", "historyStep"="HistoryStep"})
 */
abstract class AbstractStep implements StepInterface
{
    /**
     * @ORM\Id()
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     * @var integer
     */
    protected $id;

    /**
     * @ORM\Column(name="action_Id", type="integer", nullable=true)
     *
     * @var integer
     */
    protected $actionId;

    /**
     * @ORM\Column(name="caller", type="string", length=35, nullable=true)
     *
     * @var string
     */
    protected $caller;

    /**
     * @ORM\Column(name="finish_date", type="datetime", nullable=true)
     *
     * @var DateTime
     */
    protected $finishDate;

    /**
     * @ORM\Column(name="start_date", type="datetime")
     *
     * @var DateTime
     */
    protected $startDate;

    /**
     * @ORM\Column(name="due_date", type="datetime", nullable=true)
     *
     * @var DateTime
     */
    protected $dueDate;

    /**
     * @ORM\Column(name="owner", type="string", length=35, nullable=true)
     *
     * @var string
     */
    protected $owner;

    /**
     * @ORM\Column(name="status", type="string", length=40, nullable=true)
     *
     * @var string
     */
    protected $status;

    /**
     * @ORM\Column(name="step_id", type="integer")
     *
     * @var integer
     */
    protected $stepId;

    /**
     *
     * @ORM\ManyToMany(targetEntity="AbstractStep")
     * @ORM\JoinTable(
     *     name="wf_previous_step",
     *     joinColumns={@ORM\JoinColumn(name="current_step_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="previous_step_id", referencedColumnName="id")}
     * )
     *
     * @var ArrayCollection|AbstractStep[]
     */
    protected $previousSteps;


    /**
     *
     */
    public function __construct()
    {
        $this->previousSteps =  new ArrayCollection();
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
        $this->id = $id;

        return $this;
    }

    /**
     * @return integer
     */
    public function getActionId()
    {
        return $this->actionId;
    }

    /**
     * @param integer $actionId
     *
     * @return $this
     */
    public function setActionId($actionId = null)
    {
        $this->actionId = null !== $actionId ? (integer)$actionId : $actionId;

        return $this;
    }

    /**
     * @return string
     */
    public function getCaller()
    {
        return $this->caller;
    }

    /**
     * @param string $caller
     *
     * @return $this
     */
    public function setCaller($caller = null)
    {
        $this->caller = null !== $caller ? (string)$caller : $caller;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getFinishDate()
    {
        return $this->finishDate;
    }

    /**
     * @param DateTime $finishDate
     *
     * @return $this
     */
    public function setFinishDate(DateTime $finishDate = null)
    {
        $this->finishDate = $finishDate;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param DateTime $startDate
     *
     * @return $this
     */
    public function setStartDate(DateTime $startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * @param DateTime $dueDate
     *
     * @return $this
     */
    public function setDueDate(DateTime $dueDate = null)
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    /**
     * @return string
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param string $owner
     *
     * @return $this
     */
    public function setOwner($owner)
    {
        $this->owner = null !== $owner ? (string)$owner : $owner;

        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = (string)$status;

        return $this;
    }

    /**
     * @return string
     */
    public function getStepId()
    {
        return $this->stepId;
    }

    /**
     * @param string $stepId
     *
     * @return $this
     */
    public function setStepId($stepId)
    {
        $this->stepId = (string)$stepId;

        return $this;
    }

    /**
     * @return EntryInterface
     */
    abstract public function getEntry();

    /**
     * Возвращает id процесса
     *
     * @return integer
     */
    public function getEntryId()
    {
        return $this->getEntry()->getId();
    }

    /**
     * Возвращает id предыдущхи шагов
     *
     */
    public function getPreviousStepIds()
    {
        $previousStepIds = [];
        $previousSteps = $this->getPreviousSteps();

        foreach ($previousSteps as $previousStep) {
            $id = $previousStep->getId();
            $previousStepIds[$id] = $id;
        }

        return $previousStepIds;
    }

    /**
     * @return ArrayCollection|AbstractStep[]
     */
    public function getPreviousSteps()
    {
        return $this->previousSteps;
    }

    /**
     * @param ArrayCollection|AbstractStep[] $previousSteps
     *
     * @return $this
     *
     * @throws Exception\InvalidArgumentException
     */
    public function setPreviousSteps($previousSteps)
    {
        if (!is_array($previousSteps) && !$previousSteps instanceof Traversable) {
            $errMsg = 'previousSteps is not array';
            throw new Exception\InvalidArgumentException($errMsg);
        }

        foreach ($previousSteps as $previousStep) {
            if (!$previousStep instanceof AbstractStep) {
                $errMsg = sprintf('step not implement %s', AbstractStep::class);
                throw new Exception\InvalidArgumentException($errMsg);
            }
            if (!$this->previousSteps->contains($previousStep)) {
                $this->previousSteps->add($previousStep);
            }
        }
        return $this;
    }
}
