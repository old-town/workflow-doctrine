<?php
/**
 * @link    https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\Entity\Args;

use Doctrine\ORM\Mapping as ORM;
use OldTown\Workflow\Loader\ValidatorDescriptor;

/**
 * Class ValidatorArgs
 *
 * @ORM\Entity()
 *
 * @package OldTown\Workflow\Spi\Doctrine\Entity\Args
 */
class ValidatorArgs extends AbstractArgs
{
    /**
     *
     * @ORM\ManyToOne(
     *      targetEntity="OldTown\Workflow\Loader\ValidatorDescriptor",
     *      inversedBy="args"
     * )
     * @ORM\JoinColumn(name="validator_id", referencedColumnName="entity_id" )
     *
     * @var ValidatorDescriptor
     */
    protected $validator;
}
