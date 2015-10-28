<?php
/**
 * @link    https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\Entity\Args;

use Doctrine\ORM\Mapping as ORM;
use OldTown\Workflow\Loader\ValidatorDescriptor;

/**
 * Class WorkflowMetaAttributes
 *
 * @package OldTown\Workflow\Spi\Doctrine\Entity\Args
 *
 * @ORM\Entity()
 */
class WorkflowMetaAttributes extends AbstractArgs
{
    /**
     *
     * @ORM\ManyToOne(
     *      targetEntity="OldTown\Workflow\Loader\WorkflowDescriptor",
     *      inversedBy="metaAttributes"
     * )
     * @ORM\JoinColumn(name="workflow_meta_attributes_id", referencedColumnName="entity_id" )
     *
     * @var ValidatorDescriptor
     */
    protected $workflow;
}
