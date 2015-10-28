<?php
/**
 * @link    https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\Entity\Descriptor\Args;

use Doctrine\ORM\Mapping as ORM;
use OldTown\Workflow\Loader\FunctionDescriptor;

/**
 * @ORM\Entity()
 *
 * Class FunctionArgs
 *
 * @package OldTown\Workflow\Spi\Doctrine\Entity\Descriptor\Args
 */
class FunctionArgs extends AbstractArgs
{
    /**
     *
     * @ORM\ManyToOne(
     *      targetEntity="OldTown\Workflow\Loader\FunctionDescriptor",
     *      inversedBy="args"
     * )
     * @ORM\JoinColumn(name="function_id", referencedColumnName="entity_id")
     *
     * @var FunctionDescriptor
     */
    protected $function;


}
