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
 *         @ORM\Index(name="caller", columns={"caller"}),
 *         @ORM\Index(name="type", columns={"type"}),
 *     }
 * )
 */
class Step implements StepInterface
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
     * @ORM\ManyToMany(targetEntity="Step")
     * @ORM\JoinTable(
     *     name="wf_previous_step",
     *     joinColumns={@ORM\JoinColumn(name="current_step_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="previous_step_id", referencedColumnName="id")}
     * )
     *
     * @var ArrayCollection|StepInterface[]
     */
    protected $previousSteps;

    /**
     * Поле для оптимистичных блокировок
     *
     * @ORM\Version()
     * @ORM\Column(name="version", type="integer")
     *
     * @var integer
     */
    protected $version;

    /**
     * Определяет тип шага
     *
     * @ORM\Column(name="type", type="string", length=15, nullable=false)
     *
     * @var string
     */
    protected $type;

    /**
     * @ORM\ManyToOne(targetEntity="AbstractEntry", inversedBy="steps")
     * @ORM\JoinColumn(name="entry_id", referencedColumnName="id")
     *
     * @var EntryInterface
     */
    protected $entry;

    /**
     * Разрешенные типы шагов
     *
     * @var array
     */
    protected $accessType = [
        self::CURRENT_STEP => self::CURRENT_STEP,
        self::HISTORY_STEP => self::HISTORY_STEP,
    ];

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
     * @return ArrayCollection|StepInterface[]
     */
    public function getPreviousSteps()
    {
        return $this->previousSteps;
    }

    /**
     * @param ArrayCollection|StepInterface[] $previousSteps
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
            if (!$previousStep instanceof StepInterface) {
                $errMsg = sprintf('step not implement %s', StepInterface::class);
                throw new Exception\InvalidArgumentException($errMsg);
            }
            if (!$this->previousSteps->contains($previousStep)) {
                $this->previousSteps->add($previousStep);
            }
        }
        return $this;
    }

    /**
     * Возвращает тип шага
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Устанавливает тип шага
     *
     * @param string $type
     *
     * @return $this
     *
     * @throws Exception\InvalidArgumentException
     */
    public function setType($type)
    {
        if (!array_key_exists($type, $this->accessType)) {
            $errMsg = sprintf('Invalid step type %s', $type);
            throw new Exception\InvalidArgumentException($errMsg);
        }
        $this->type = $type;

        return $this;
    }

    /**
     * @return EntryInterface
     */
    public function getEntry()
    {
        return $this->entry;
    }

    /**
     * @param EntryInterface $entry
     *
     * @return $this
     */
    public function setEntry(EntryInterface $entry)
    {
        $this->entry = $entry;

        if (!$entry->getSteps()->contains($this)) {
            $entry->getSteps()->add($this);
        }

        return $this;
    }
}
