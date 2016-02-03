<?php
/**
 * @link    https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Class CurrentStep
 *
 * @package OldTown\Workflow\Spi\Doctrine\Entity
 *
 * @ORM\Entity(repositoryClass="\OldTown\Workflow\Spi\Doctrine\EntityRepository\StepRepository")
 */
class CurrentStep extends Step
{


}
