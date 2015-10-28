<?php
/**
 * @link    https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\Entity\Descriptor\Args;

use Doctrine\ORM\Mapping as ORM;


/**
 * Class AbstractArgs
 *
 * @ORM\Entity()
 * @ORM\Table(name="workflow_args")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 *
 * @package OldTown\Workflow\Spi\Doctrine\Entity\Descriptor\Args
 */
class AbstractArgs
{
    /**
     * @ORM\Id()
     * @ORM\Column(name="id", type="integer")
     *
     * @var integer
     */
    protected $id;

    /**
     * @ORM\Id()
     * @ORM\Column(name="name", type="string", nullable=false)
     *
     * @var string
     */
    protected $name;

    /**
     * @ORM\Column(name="value", type="text", nullable=false)
     *
     * @var string
     */
    protected $value;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = (string)$name;

        return $this;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = (string)$value;

        return $this;
    }


}
