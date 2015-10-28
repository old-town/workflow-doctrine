<?php
/**
 * @link    https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\Entity\Args;

use Doctrine\ORM\Mapping as ORM;
use OldTown\Workflow\Loader\FunctionDescriptor;


/**
 * Class FunctionArgs
 *
 * @ORM\Entity()
 *
 * @package OldTown\Workflow\Spi\Doctrine\Entity\Args
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
