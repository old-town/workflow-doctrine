<?php
/**
 * @link    https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\Entity;

use OldTown\Workflow\Loader\WorkflowDescriptor;
use Doctrine\ORM\Mapping as ORM;


/**
 * Class WorkflowName
 *
 * @ORM\Entity()
 * @ORM\Table(name="workflow_name")
 *
 * @package OldTown\Workflow\Spi\Doctrine
 */
class WorkflowName
{
    /**
     * @ORM\Id()
     * @ORM\Column(name="workflow_name", type="string")
     * @ORM\GeneratedValue(strategy="NONE")
     *
     * @var string
     */
    protected $workflowName;

    /**
     * @ORM\ManyToOne(targetEntity="OldTown\Workflow\Loader\WorkflowDescriptor",  cascade={"persist"})
     * @ORM\JoinColumn(name="workflow_descriptor_id", referencedColumnName="entity_id")
     *
     *
     * @var WorkflowDescriptor
     */
    protected $workflowDescriptor;

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
     * @return WorkflowDescriptor
     */
    public function getWorkflowDescriptor()
    {
        return $this->workflowDescriptor;
    }

    /**
     * @param WorkflowDescriptor $workflowDescriptor
     *
     * @return $this
     */
    public function setWorkflowDescriptor(WorkflowDescriptor $workflowDescriptor)
    {
        $this->workflowDescriptor = $workflowDescriptor;

        return $this;
    }


}
