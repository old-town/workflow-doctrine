<?php
/**
 * @link    https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\Entity\Descriptor\Args;

use Doctrine\ORM\Mapping as ORM;
use OldTown\Workflow\Spi\Doctrine\Entity\OverrideDescriptor\Step;

/**
 * Class WorkflowMetaAttributes
 *
 * @package OldTown\Workflow\Spi\Doctrine\Entity\Descriptor\Args
 *
 * @ORM\Entity()
 *
 *
 */
class StepMetaAttributes extends AbstractArgs
{
    /**
     *
     * @ORM\ManyToOne(
     *      targetEntity="OldTown\Workflow\Spi\Doctrine\Entity\OverrideDescriptor\Step",
     *      inversedBy="metaAttributes"
     * )
     * @ORM\JoinColumn(name="step_meta_attributes_id", referencedColumnName="entity_id" )
     *
     * @var Step
     */
    protected $step;
}
